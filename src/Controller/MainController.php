<?php

namespace App\Controller;

use App\Repository\ActualityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController {
	/**
	 * @Route("/", name="home")
	 * 
	 * @param ActualityRepository $actualityRepository
	 * 
	 * @return Response
	 */
	public function home(ActualityRepository $actualityRepository): Response {
		// Get the first actuality
		$actuality = $actualityRepository->findFirst();

		return $this->render("home/index.html.twig", [
			"actuality" => $actuality,
		]);
	}

	/**
	 * @Route("/presentation", name="presentation")
	 * 
	 * @return Response
	 */
	public function presentation(): Response {
		return $this->render("home/presentation.html.twig");
	}
}