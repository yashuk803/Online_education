<?php

/*
 * This file is part of Symfony DEMO Online Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller;

use App\Form\LessonFormType;
use App\Lesson\Repository\LessonRepositoryInterface;
use App\Utils\Transcoding;
use FFMpeg\Format\Video\WebM;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

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
    private $lessonPresentation;

    /**
     * @var ParameterBagInterface
     */
    private $params;

    public function __construct(
        LessonRepositoryInterface $lessonPresentation,
        ParameterBagInterface $params
    ) {
        $this->lessonPresentation = $lessonPresentation;
        $this->params = $params;
    }

    /**
     * Displays a form to edit an existing Lesson entity.
     *
     * @IsGranted("ROLE_USER")
     * @Route("/edit-lesson/{id}", name="edit-lesson", requirements={"id"="^\d+$"})
     */
    public function edit(
        Request $request,
        AuthorizationCheckerInterface $authChecker,
        int $id
    ): Response {
        $lesson = $this->lessonPresentation->findById($id);

        if ($this->getUser()->getId() !== $lesson->getCourse()->getUser()->getId()) {
            throw $this->createAccessDeniedException('Access denied');
        }

        $form = $this->createForm(LessonFormType::class, $lesson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($request->request->has('squeeze') && $request->files->get('lesson_form')['videoFile']) {
                $originName = ($request->files->get('lesson_form')['videoFile'])->getClientOriginalName();
                $pathSave = $this->params->get('kernel.project_dir') . '/public' . $this->params->get('app.path.video_path_lessons');
                //This help transcoding video in WebM format, when client want to squeeze video file
                $transcoding = new Transcoding($lesson->getVideoFile(), $pathSave, $originName, new WebM());
                $fileName = $transcoding->saveVideo();

                $file = new File($lesson->getVideoFile());
                $lesson->setVideoFile($file);
                $lesson->setVideo($fileName);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lesson);
            $entityManager->flush();

            return $this->redirectToRoute('syllabus-course', ['id' => $lesson->getCourse()->getId()]);
        }

        return $this->render('lesson/edit.html.twig', [
            'lessonForm' => $form->createView(),
        ]);
    }
}
