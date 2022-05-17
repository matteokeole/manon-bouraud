<?php

namespace App\Controller;

use App\Form\ActualityType;
use App\Repository\ActualityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController {
	/**
	 * @Route("/admin", name="admin")
	 * 
	 * @param EntityManagerInterface	$manager
	 * @param ActualityRepository		$actualityRepository
	 * @param Request					$request
	 * 
	 * @return Response|RedirectResponse
	 */
	public function index(EntityManagerInterface $manager, ActualityRepository $actualityRepository, Request $request) {
		if (!$this->getUser()) return $this->redirectToRoute("app_login");

		$isEdited = false;

		// Get the first actuality
		$actuality = $actualityRepository->findFirst();

		// Create actuality edition form
		$form = $this->createForm(ActualityType::class, $actuality);
		$form->handleRequest($request);

		// Handle form submit event
		if ($form->isSubmitted() && $form->isValid()) {
			$isEdited = true;

			// Update actuality date
			$actuality->setDate(new \DateTime);

			$manager->flush();
		}

		return $this->render("admin/index.html.twig", [
			"actuality" => $form->createView(),
			"isEdited"	=> $isEdited,
		]);
	}
}