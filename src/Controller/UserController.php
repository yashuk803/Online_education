<?php

namespace App\Controller;

use App\Course\Service\CoursePresentationServiceInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Controller used to manage current user.
 *
 * @Route("/{slug}", requirements={"slug"="^@[A-Za-z0-9-_]+$"})
 * @IsGranted("ROLE_USER")
 * @author Mariia Tarantsova <yashuk803@gmail.com>
 */
class UserController extends AbstractController
{
    private $coursePresentation;

    public function __construct(CoursePresentationServiceInterface $coursePresentation)
    {
        $this->coursePresentation = $coursePresentation;
    }
    /**
     * Renders profile users.
     *
     * @Route("/", name="user_index")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig');
    }

    /**
     * Finds and displays a User's courses.
     *
     * @Route("/courses", name="user_courses")
     */
    public function courses(): Response
    {
        $courses = $this->coursePresentation->findByUser($this->getUser());

        return $this->render('user/courses.html.twig', [
            'courses' => $courses,
        ]);
    }
}
