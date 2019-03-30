<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 *
 * @Route("/{slug}", requirements={"slug"="^@[A-Za-z0-9-_]+$"})
 * @IsGranted("ROLE_USER")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", methods={"GET", "POST"}, name="user_index")
     */
    public function index()
    {
        return $this->render('user/index.html.twig');
    }
}
