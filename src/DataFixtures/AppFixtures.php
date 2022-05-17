<?php

namespace App\DataFixtures;

use App\Entity\Actuality;
use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture {
	/** @var UserPasswordEncoderInterface */
	private $passwordEncoder;

	/**
	 * @param UserPasswordEncoderInterface $passwordEncoder
	 */
	public function __construct(UserPasswordEncoderInterface $passwordEncoder) {
		$this->passwordEncoder = $passwordEncoder;
	}

	/**
	 * @param ObjectManager $manager
	 */
	public function load(ObjectManager $manager): void {
		// Create an administrator user
		$admin = (new Admin())
			->setEmail("matteoo34@icloud.com")
			->setRoles(["ROLE_ADMIN"]);
		$admin->setPassword($this->passwordEncoder->encodePassword($admin, "0000"));

		// Create an empty actuality
		$actuality = new Actuality();

		$manager->persist($admin);
		$manager->persist($actuality);
		$manager->flush();
	}
}