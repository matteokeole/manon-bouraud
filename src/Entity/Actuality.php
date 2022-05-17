<?php

namespace App\Entity;

use App\Repository\ActualityRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ActualityRepository::class)
 */
class Actuality {
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="boolean")
	 */
	private $visible;

	/**
	 * @ORM\Column(type="datetime")
	 */
	private $date;

	/**
	 * @ORM\Column(type="text", nullable="true")
	 * 
	 * @Assert\Length(max="65535", maxMessage="Ce champ ne doit pas faire plus de {{ limit }} caractères.")
	 */
	private $content;

	public function __construct() {
		$this->visible = true;
		$this->date = new \DateTime;
	}

	public function getId(): ?int {
		return $this->id;
	}

	public function isVisible(): ?bool {
		return $this->visible;
	}

	public function setVisible(bool $visible): self {
		$this->visible = $visible;

		return $this;
	}

	public function getDate(): ?string {
		return $this->date->format("d/m/y à H:i");
	}

	public function setDate(\DateTimeInterface $date): self {
		$this->date = $date;
		 
		return $this;
	}

	public function getContent(): ?string {
		return $this->content;
	}

	public function setContent(?string $content): self {
		$this->content = $content;
		 
		return $this;
	}
}