<?php

namespace App\Controller;

use App\Course\Service\CoursePresentationServiceInterface;

use App\User\Repository\UserRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;

/**
 *
 * @Route("/{slug}", requirements={"slug"="^@[A-Za-z0-9-_]+$"})
 * @IsGranted("ROLE_USER")
 */
class UserController extends AbstractController
{
    private $coursePresentation;

    public function __construct(CoursePresentationServiceInterface $coursePresentation)
    {
        $this->coursePresentation = $coursePresentation;
    }
    /**
     * @Route("/", methods={"GET", "POST"}, name="user_index")
     */
    public function index()
    {
        return $this->render('user/index.html.twig');
    }

    /**
     * @Route("/courses", methods={"GET", "POST"}, name="user_courses")
     */
    public function courses(UserRepositoryInterface  $userPresentattion)
    {
        $courses = $this->coursePresentation->findByUser($this->getUser());

        return $this->render('user/courses.html.twig', [
            'courses' => $courses,
        ]);
    }
}
