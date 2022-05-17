<?php

namespace App\Repository;

use App\Entity\Actuality;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Actuality>
 *
 * @method Actuality|null	find($id, $lockMode = null, $lockVersion = null)
 * @method Actuality|null	findOneBy(array $criteria, array $orderBy = null)
 * @method Actuality[]		findAll()
 * @method Actuality[]		findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActualityRepository extends ServiceEntityRepository {
	/**
	 * @param ManagerRegistry $registry
	 */
	public function __construct(ManagerRegistry $registry) {
		parent::__construct($registry, Actuality::class);
	}

	public function findFirst() {
		return $this
			->createQueryBuilder("actuality")
			->orderBy("actuality.date", "ASC")
			->setMaxResults(1)
			->getQuery()
			->getOneOrNullResult();
	}
}