<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController {
	/**
	 * @Route("/login", name="login")
	 * 
	 * @param AuthenticationUtils $authenticationUtils
	 * 
	 * @return RedirectResponse|Response
	 */
	public function login(AuthenticationUtils $authenticationUtils) {
		if ($this->getUser()) return $this->redirectToRoute("admin");

		// Get the last username entered by the user
		$lastUsername = $authenticationUtils->getLastUsername();

		// Get the login error if there is one
		$error = $authenticationUtils->getLastAuthenticationError();

		return $this->render("security/index.html.twig", [
			"last_username"	=> $lastUsername,
			"error"			=> $error,
		]);
	}

	/**
	 * @Route("/logout", name="logout")
	 * 
	 * @throws \LogicException
	 */
	public function logout(): void {
		throw new \LogicException("This method can be blank - it will be intercepted by the logout key on your firewall.");
	}
}