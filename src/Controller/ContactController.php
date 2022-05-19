<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController {
	/**
	 * @Route("/contact", name="contact")
	 * 
	 * @param MailerInterface	$mailer
	 * @param Request			$request
	 * 
	 * @return Response
	 */
	public function index(MailerInterface $mailer, Request $request): Response {
		$isSent = false;
		$error = "";

		// Create form
		$form = $this->createForm(ContactType::class);
		$form->handleRequest($request);

		// Handle form submit event
		if ($form->isSubmitted() && $form->isValid()) {
			// Create e-mail template
			$email = (new TemplatedEmail())
				->from($form->get("email")->getData())
				->to("matteo@keole.net")
				->subject("Demande de contact sur manon-bouraud.fr")
				->htmlTemplate("email/contact.html.twig")
				->context([
					"name"		=> $form->get("name")->getData(),
					"message"	=> nl2br($form->get("message")->getData()),
				]);

			// Send e-mail
			try {
				$mailer->send($email);
				$isSent = true;
			} catch (TransportExceptionInterface $e) {
				$error = "Une erreur est survenue lors de l'envoi de votre demande.<br>Veuillez rééssayer.";
			}
		}

		return $this->render("contact/index.html.twig", [
			"contact"	=> $form->createView(),
			"isSent"	=> $isSent,
			"error"		=> $error,
		]);
	}
}