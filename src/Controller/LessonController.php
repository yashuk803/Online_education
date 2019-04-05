<?php


namespace App\Controller;

use App\Entity\Lesson;
use App\Form\LessonFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Routing\Annotation\Route;
class LessonController  extends AbstractController
{

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/edit-lesson/{id}", name="edit-lesson", requirements={"id"="^\d+$"})
     */
    public function newLesson(
        Request $request,
        AuthorizationCheckerInterface $authChecker,
        int $id
    ): Response
    {

        $course = new Lesson();
        $form = $this->createForm(LessonFormType::class, $course);
        $form->handleRequest($request);


        return $this->render('lesson/edit_lesson.html.twig', [
            'lessonForm' => $form->createView(),
        ]);
    }
}
