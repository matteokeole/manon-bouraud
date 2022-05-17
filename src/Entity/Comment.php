<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 */
class Comment {
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=255)
	 *
	 * @Assert\NotBlank(message="Ce champ est requis.")
	 * @Assert\Length(max="255", maxMessage="Ce champ ne doit pas faire plus de {{ limit }} caractères.")
	 */
	private $author;

	/**
	 * @ORM\Column(type="datetime")
	 */
	private $date;

	/**
	 * @ORM\Column(type="text")
	 *
	 * @Assert\NotBlank(message="Ce champ est requis.")
	 * @Assert\Length(max="65535", maxMessage="Ce champ ne doit pas faire plus de {{ limit }} caractères.")
	 */
	private $message;

	public function __construct() {
		$this->date = new \DateTime;
	}

	public function getId(): ?int {
		return $this->id;
	}

	public function getAuthor(): ?string {
		return $this->author;
	}

	public function setAuthor(string $author): self {
		$this->author = $author;

		return $this;
	}

	public function getDate(): ?string {
		return $this->date->format("d/m/y à H:i");
	}

	public function setDate(\DateTimeInterface $date): self {
		$this->date = $date;

		return $this;
	}

	public function getMessage(): ?string {
		return $this->message;
	}

	public function setMessage(string $message): self {
		$this->message = $message;

		return $this;
	}
}