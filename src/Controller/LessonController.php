<?php

/*
 * This file is part of Symfony DEMO Online Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller;

use App\Course\Service\CoursePresentationServiceInterface;
use App\Entity\Lesson;
use App\Form\LessonFormType;
use App\Lesson\FormLessonModel;
use App\Lesson\Repository\LessonRepositoryInterface;
use App\Lesson\Service\LessonManagementServiceInterface;
use App\Lesson\Service\LessonPresentationServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller used to any registered users edit lessons.
 *
 * @author Mariia Tarantsova <yashuk803@gmail.com>
 */
class LessonController extends AbstractController
{
    /**
     * @var LessonRepositoryInterface
     */
    private $lessonPresentationService;

    private $coursePresentation;

    private $lessonManagementService;

    public function __construct(
        LessonPresentationServiceInterface $lessonPresentationService,
        CoursePresentationServiceInterface $coursePresentation,
        LessonManagementServiceInterface $lessonManagementService
    ) {
        $this->lessonPresentationService = $lessonPresentationService;
        $this->lessonManagementService = $lessonManagementService;
        $this->coursePresentation = $coursePresentation;
    }

    /**
     * Displays a form to edit an existing Lesson entity.
     *
     * @IsGranted("ROLE_USER")
     * @Route("/edit-lesson/{id}", name="edit-lesson", requirements={"id"="^\d+$"})
     */
    public function edit(
        Request $request,
        int $id
    ): Response {
        $lesson = $this->lessonPresentationService->findById($id);
        $course = $this->coursePresentation->findById($lesson->getCourses());

        $formLesson = new FormLessonModel();

        if (!$course->isCourseAuthor($this->getUser()->getId())) {
            throw $this->createAccessDeniedException('Access denied');
        }

        $form = $this->createForm(LessonFormType::class, $formLesson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formLesson->setCourse($course->getId());
            $this->lessonManagementService->setData(
                new Lesson(),
                $formLesson,
                $request->request->has('squeeze')
            );

            return $this->redirectToRoute('syllabus-course', ['id' => $course->getId()]);
        }

        return $this->render('lesson/edit.html.twig', [
            'lessonForm' => $form->createView(),
        ]);
    }
}
