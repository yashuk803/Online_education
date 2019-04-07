<?php

/*
 * This file is part of Symfony DEMO Onlain Education Application.
 * (c) Tarantsova Mariia <yashuk803@gmail.com>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller;

use App\Course\Service\CoursePresentationServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Mariia Tarantsova <yashuk803@gmail.com>
 */
class DefaultController extends AbstractController
{
    private $coursePresentation;

    public function __construct(CoursePresentationServiceInterface $coursePresentation)
    {
        $this->coursePresentation = $coursePresentation;
    }

    /**
     * Renders site home page.
     *
     * @Route("/", name="index")
     *
     * @return Response
     */
    public function index(): Response
    {
        $courses = $this->coursePresentation->getLastFiveCourses();


        return $this->render('default/index.html.twig', [
                'courses' => $courses,
            ]);
    }
}
