<?php


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

class LessonController extends AbstractController
{

    private $lessonPresentation;
    private $params;

    public function __construct(
        LessonRepositoryInterface $lessonPresentation,
        ParameterBagInterface $params
    )
    {
        $this->lessonPresentation = $lessonPresentation;
        $this->params = $params;
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/edit-lesson/{id}", methods={"GET", "POST"}, name="edit-lesson", requirements={"id"="^\d+$"})
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
        if($form->isSubmitted() && $form->isValid()) {
            $originName = ($request->files->get('lesson_form')['videoFile'])->getClientOriginalName();

            if($request->request->has('squeeze') && $request->files->get('lesson_form')['videoFile']) {

                $pathSave = $this->params->get('kernel.project_dir').'/public'.$this->params->get('app.path.video_path_lessons');
                $transcoding = new Transcoding($lesson->getVideoFile(), $pathSave, $originName, new WebM());
                $fileName = $transcoding->saveVideo();

                $file = new File($lesson->getVideoFile());
                $lesson->setVideoFile($file);
                $lesson->setVideo($fileName);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lesson);
            $entityManager->flush();

            return $this->redirect('/syllabus-course/' . $lesson->getCourse()->getId());
        }

        return $this->render('lesson/edit.html.twig', [
            'lessonForm' => $form->createView(),
        ]);
    }

}
