<?php

namespace App\Form;

use App\Entity\Actuality;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActualityType extends AbstractType {
	public function buildForm(FormBuilderInterface $builder, array $options): void {
		$builder
			->add("content", TextareaType::class, [
				"required"	=> false,
				"attr"		=> [
					"placeholder" => "Contenu de l'actualité",
				],
			])
			->add("visible", CheckboxType::class, [
				"required"	=> false,
				"label"		=> "Afficher sur la page d'accueil",
			])
			->add("submit", SubmitType::class, [
				"label"	=> "Enregistrer",
			]);
	}

	public function configureOptions(OptionsResolver $resolver): void {
		$resolver->setDefaults([
			"data_class" => Actuality::class,
		]);
	}
}