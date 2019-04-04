<?php

namespace App\Controller;

use App\Course\Service\CoursePresentationServiceInterface;
use App\Entity\Course;
use App\Form\CourseFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class CourseController extends AbstractController
{
    private $coursePresentation;

    public function __construct(CoursePresentationServiceInterface $coursePresentation)
    {
        $this->coursePresentation = $coursePresentation;
    }

    /**
     * @Route("/course", name="courses")
     *
     */
    public function index()
    {
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/new-course", name="new-course")
     */
    public function newCourse(Request $request, AuthorizationCheckerInterface $authChecker): Response
    {
        $course = new Course();
        $form = $this->createForm(CourseFormType::class, $course);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $course->setUser($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($course);
            $entityManager->flush();

            return $this->redirect('/edit-course/' . $course->getId());
        }

        return $this->render('course/new_course.html.twig', [
            'courseForm' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/edit-course/{id}", name="edit-course", requirements={"id"="^\d+$"})
     */
    public function editCourse($id)
    {
        $course = $this->coursePresentation->findById($id);

        if (!$course) {
            throw $this->createNotFoundException('The course does not exist');
        }

        if ($this->getUser()->getId() !== $course->getUser()) {
            throw $this->createAccessDeniedException('Access denied');
        }

        return $this->render('course/edit_course.html.twig', [
            'course' => $course,
            'lessons' => '',
        ]);
    }

    /**
     *
     * @Route("/course/{id}", name="show-course", requirements={"id"="^\d+$"})
     */
    public function showCourse()
    {
    }

    /**
     *
     * @Route("/course/{id}/reviews", name="reviews-course", requirements={"id"="^\d+$"})
     */
    public function reviewCourse()
    {
    }

    /**
     *
     * @Route("/course/{id}/reviews", name="syllabus-course", requirements={"id"="^\d+$"})
     */
    public function syllabusCourse()
    {
    }
}
