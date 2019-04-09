<?php

/*
 * This file is part of Symfony DEMO Online Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller;

use App\Course\FormCourseModel;
use App\Course\Service\CourseManagementServiceInterface;
use App\Course\Service\CoursePresentationServiceInterface;
use App\Entity\Course;
use App\Entity\Lesson;
use App\Form\CourseFormType;
use App\Form\LessonXmlFormType;
use App\Lesson\FormLessonModel;
use App\Lesson\Service\LessonManagementServiceInterface;
use App\Lesson\Service\LessonPresentationServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
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
    private $coursePresentation;

    private $lessonPresentation;

    private $courseManagementService;

    private $lessonManagementService;

    private $params;

    public function __construct(
        CoursePresentationServiceInterface $coursePresentation,
        LessonPresentationServiceInterface $lessonPresentation,
        CourseManagementServiceInterface $courseManagementService,
        LessonManagementServiceInterface $lessonManagementService,
        ParameterBagInterface $params
    ) {
        $this->coursePresentation = $coursePresentation;
        $this->lessonPresentation = $lessonPresentation;
        $this->courseManagementService = $courseManagementService;
        $this->lessonManagementService = $lessonManagementService;
        $this->params = $params;
    }

    /**
     * Lists all Courses entities.
     *
     * @Route("/courses/", methods={"GET"}, name="courses")
     */
    public function index(): Response
    {
        $courses = $this->coursePresentation->getAll();

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
        $formCourse = new FormCourseModel();
        $course = new Course($this->getUser());

        $form = $this->createForm(CourseFormType::class, $formCourse);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $course = $this->courseManagementService->setData(
                $course,
                $formCourse,
                $request->request->has('squeeze')
            );

            return $this->redirectToRoute('edit-course', ['id' => $course->getId()]);
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

        if (!$course->isCourseAuthor($this->getUser()->getId())) {
            throw $this->createAccessDeniedException('Access denied');
        }

        $formLesson = new FormLessonModel();

        $form = $this->createForm(LessonXmlFormType::class, $formLesson);
        $form->handleRequest($request);

        if ($request->isXmlHttpRequest() && $form->isSubmitted() && $form->isValid()) {
            $formLesson->setCourse($id);
            $lesson = $this->lessonManagementService->setData(
                new Lesson(),
                $formLesson,
                false
            );

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
            'lessonForm' => $form->createView(),
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
