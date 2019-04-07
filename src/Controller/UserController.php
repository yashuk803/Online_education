<?php

/*
 * This file is part of Symfony DEMO Online Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
 *
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
        $courses = $this->coursePresentation->findByUser($this->getUser()->getId());

        return $this->render('user/courses.html.twig', [
            'courses' => $courses,
        ]);
    }
}
