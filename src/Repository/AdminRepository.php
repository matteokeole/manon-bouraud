<?php

namespace App\Repository;

use App\Entity\Admin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<Admin>
 * 
 * @method Admin|null	find($id, $lockMode = null, $lockVersion = null)
 * @method Admin|null	findOneBy(array $criteria, array $orderBy = null)
 * @method Admin[]		findAll()
 * @method Admin[]		findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdminRepository extends ServiceEntityRepository implements PasswordUpgraderInterface {
	/**
	 * @param ManagerRegistry $registry
	 */
	public function __construct(ManagerRegistry $registry) {
		parent::__construct($registry, Admin::class);
	}

	/**
	 * @param Admin	$entity
	 * @param bool	$flush=false
	 */
	public function add(Admin $entity, bool $flush = false): void {
		$this->getEntityManager()->persist($entity);

		if ($flush) $this->getEntityManager()->flush();
	}

	/**
	 * @param Admin	$entity
	 * @param bool	$flush=false
	 */
	public function remove(Admin $entity, bool $flush = false): void {
		$this->getEntityManager()->remove($entity);

		if ($flush) $this->getEntityManager()->flush();
	}

	/**
	 * Used to upgrade (rehash) the user's password automatically over time.
	 * 
	 * @param PasswordAuthenticatedUserInterface	$user
	 * @param string								$newHashedPassword
	 */
	public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void {
		if (!$user instanceof Admin) throw new UnsupportedUserException(sprintf("Instances of \"%s\" are not supported.", \get_class($user)));

		$user->setPassword($newHashedPassword);

		$this->add($user, true);
	}
}