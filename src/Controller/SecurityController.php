<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

/**
 * Controller used to manage the application security.
 *
 * @author Mariia Tarantsova <yashuk803@gmail.com>
 */
class SecurityController extends AbstractController
{
    use TargetPathTrait;
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
        $this->saveTargetPath($request->getSession(), 'main', $this->generateUrl('index'));
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    /**
     * This is the route the user can use to logout.
     *
     * @Route("/logout", name="logout")
     */
    public function logoutAction(): void
    {
        throw new \Exception('this should not be reached!');
    }
}
