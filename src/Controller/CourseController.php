<?php

namespace App\Controller;

use App\Course\Repository\CourseRepositoryInterface;
use App\Entity\Course;
use App\Entity\Lesson;
use App\Form\CourseFormType;
use App\Lesson\Service\LessonPresentationServiceInterface;
use App\Utils\Transcoding;
use FFMpeg\Format\Video\WebM;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Controller used to manage create, edit courses
 * contents in the public part of the site.
 *
 * @author Mariia Tarantsova <yashuk803@gmail.com>
 */

class CourseController extends AbstractController
{
    /**
     * @var CourseRepositoryInterface
     */
    private $coursePresentation;

    /**
     * @var LessonPresentationServiceInterface
     */
    private $lessonPresentation;

    /**
     * @var ParameterBagInterface
     */
    private $params;

    public function __construct(
        CourseRepositoryInterface $coursePresentation,
        LessonPresentationServiceInterface $lessonPresentation,
        ParameterBagInterface $params
    ) {
        $this->coursePresentation = $coursePresentation;
        $this->lessonPresentation = $lessonPresentation;
        $this->params = $params;
    }

    /**
     * Lists all Courses entities.
     *
     * @Route("/courses/", methods={"GET"}, name="courses")
     */
    public function index(): Response
    {
        $courses = $this->coursePresentation->findAll();

        return $this->render('course/index.html.twig', [
            'courses' => $courses,
        ]);
    }

    /**
     * Creates a new Courses entity.
     *
     * @IsGranted("ROLE_USER")
     * @Route("/new-course", name="new-course")
     */
    public function create(Request $request, AuthorizationCheckerInterface $authChecker): Response
    {
        $course = new Course();
        $form = $this->createForm(CourseFormType::class, $course);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $course->setUser($this->getUser());

            if ($request->request->has('squeeze') && $request->files->get('lesson_form')['videoFile']) {
                $originName = ($request->files->get('lesson_form')['videoFile'])->getClientOriginalName();
                $pathSave = $this->params->get('kernel.project_dir') . '/public' . $this->params->get('app.path.video_path_courses');
                //This help transcoding video in WebM format, when client want to squeeze video file
                $transcoding = new Transcoding($course->getVideoFile(), $pathSave, $originName, new WebM());
                $fileName = $transcoding->saveVideo();

                $file = new File($course->getVideoFile());
                $course->setVideoFile($file);
                $course->setVideo($fileName);
            }


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($course);
            $entityManager->flush();

            return $this->redirect('/edit-course/' . $course->getId());
        }

        return $this->render('course/create.html.twig', [
            'courseForm' => $form->createView(),
        ]);
    }

    /**
     * Displays a form to edit an existing Course entity.
     * XmlHttpRequest used for create lessons and make relationship with course.
     *
     * @IsGranted("ROLE_USER")
     * @Route("/edit-course/{id}", name="edit-course", requirements={"id"="^\d+$"})
     */
    public function edit(Request $request, int $id): Response
    {
        $course = $this->coursePresentation->findById($id);
        $lessons = $this->lessonPresentation->findByCourse($id);

        if (!$course) {
            throw $this->createNotFoundException('The course does not exist');
        }

        if ($this->getUser()->getId() !== $course->getUser()->getId()) {
            throw $this->createAccessDeniedException('Access denied');
        }
        $lesson = new Lesson();

        if ($request->isXmlHttpRequest()) {
            $entityManager = $this->getDoctrine()->getManager();
            $lesson->setCourse($course);
            $lesson->setName($request->request->get('name'));
            $entityManager->persist($lesson);
            $entityManager->flush();

            $encoders = [new JsonEncoder()];
            $normalizers = [new ObjectNormalizer()];
            $serializer = new Serializer($normalizers, $encoders);
            // Serialize your object in Json
            $jsonObject = $serializer->serialize($lesson, 'json', [
                'circular_reference_handler' => function ($object) {
                    return $object->getId();
                },
            ]);

            return new JsonResponse($jsonObject, 200, [], true);
        }

        return $this->render('course/edit.html.twig', [
            'course' => $course,
            'lessons' => $lessons,
        ]);
    }

    /**
     * Finds and displays a Course entity.
     *
     * @Route("/course/{id}", name="show-course", methods={"GET"}, requirements={"id"="^\d+$"})
     */
    public function show(int $id): Response
    {
        $course = $this->coursePresentation->findById($id);

        return $this->render('course/show.html.twig', [
            'course' => $course,
        ]);
    }

    /**
     * Find and show all lessons who belong to the course.
     *
     * @Route("/course/{id}/syllabus", methods={"GET"}, name="syllabus-course", requirements={"id"="^\d+$"})
     */
    public function syllabus(int $id): Response
    {
        $course = $this->coursePresentation->findById($id);
        $lessons = $this->lessonPresentation->findByCourse($id);

        return $this->render('course/syllabus.html.twig', [
            'course' => $course,
            'lessons' => $lessons,
        ]);
    }
}
