<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/prestations", name="prestation-")
 */
class PrestationController extends AbstractController {
	/**
	 * @Route("/marche-nordique", name="walk")
	 * 
	 * @return Response
	 */
	public function walk(): Response {
		return $this->render("prestations/walk.html.twig");
	}

	/**
	 * @Route("/accomp-fumeurs", name="smokers")
	 * 
	 * @return Response
	 */
	public function smokers(): Response {
		return $this->render("prestations/smokers.html.twig");
	}

	/**
	 * @Route("/formations", name="formations")
	 * 
	 * @return Response
	 */
	public function formations(): Response {
		return $this->render("prestations/formations.html.twig");
	}
}