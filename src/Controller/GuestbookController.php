<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class GuestbookController extends AbstractController {
	/**
	 * @Route("/livredor", name="guestbook")
	 * 
	 * @param EntityManagerInterface	$manager
	 * @param CommentRepository			$commentRepository
	 * @param MailerInterface			$mailer
	 * @param Request					$request
	 * 
	 * @return RedirectResponse|Response
	 */
	public function index(EntityManagerInterface $manager, CommentRepository $commentRepository, MailerInterface $mailer, Request $request) {
		$hasCommented = false;

		// Get all comments sorted by last creation
		$comments = $commentRepository->findBy([], [
			"date" => "DESC",
		]);

		// Create new comment
		$comment = new Comment();

		// Create form
		$form = $this->createForm(CommentType::class, $comment);
		$form->handleRequest($request);

		// Handle form submit event
		if ($form->isSubmitted() && $form->isValid()) {
			$hasCommented = true;

			$manager->persist($comment);
			$manager->flush();

			// Create e-mail template
			$email = (new TemplatedEmail())
				->from("matteo@keole.net")
				->to("matteo@keole.net")
				->subject("Nouveau commentaire sur manon-bouraud.fr")
				->htmlTemplate("email/comment.html.twig")
				->context([
					"author"	=> $form->get("author")->getData(),
					"message"	=> nl2br($form->get("message")->getData()),
				]);

			// Send e-mail
			try {$mailer->send($email);}
			catch (TransportExceptionInterface $e) {return $e;}

			// Get all comments sorted by last creation, including the new one
			$comments = $commentRepository->findBy([], [
				"date" => "DESC",
			]);
		}

		return $this->render("guestbook/index.html.twig", [
			"comments"		=> $comments,
			"guestbook"		=> $form->createView(),
			"hasCommented"	=> $hasCommented,
		]);
	}
}