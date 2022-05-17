<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GuestbookController extends AbstractController {
	/**
	 * @Route("/livredor", name="guestbook")
	 * 
	 * @param EntityManagerInterface	$manager
	 * @param CommentRepository			$commentRepository
	 * @param Request					$request
	 * 
	 * @return Response|RedirectResponse
	 */
	public function index(EntityManagerInterface $manager, CommentRepository $commentRepository, Request $request) {
		$hasCommented = false;

		// Get all comments, sorted by last creation
		$comments = $commentRepository->findBy([], ["id" => "DESC"]);

		// Create new comment
		$comment = new Comment();

		// Create form
		$form = $this->createForm(CommentType::class, $comment, []);
		$form->handleRequest($request);

		// Handle form submit event
		if ($form->isSubmitted() && $form->isValid()) {
			$hasCommented = true;

			$manager->persist($comment);
			$manager->flush();
		}

		return $this->render("guestbook/index.html.twig", [
			"comments"		=> $comments,
			"guestbook"		=> $form->createView(),
			"hasCommented"	=> $hasCommented,
		]);
	}
}