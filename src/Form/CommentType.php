<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CommentType extends AbstractType {
	public function buildForm(FormBuilderInterface $builder, array $options): void {
		$builder
			->add("author", TextType::class, [
				"required"	=> true,
				"attr"		=> [
					"placeholder" => "Votre nom *",
				],
			])
			->add("message", TextareaType::class, [
				"required"	=> true,
				"attr"		=> [
					"placeholder" => "Votre message *",
				],
			])
			->add("submit", SubmitType::class, [
				"label"	=> "Ajouter",
			]);
	}
}