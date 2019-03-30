<?php

namespace App\Controller;

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
    /**
     * @Route("/course", name="courses")
     */
    public function index()
    {


    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/new-course", name="new-course")
     */
    public function newCourse(Request $request, AuthorizationCheckerInterface $authChecker):Response
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
     * @Route("/edit-course/{id}", name="edit-course", requirements={"id"="^\d+$"})
     */
    public function editCourse()
    {
        dd(123);
    }
}
