<?php

namespace App\Repository;

use App\Entity\CustomersRating;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CustomersRating|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomersRating|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomersRating[]    findAll()
 * @method CustomersRating[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomersRatingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomersRating::class);
    }

    public function findIfOfferIsRated($user, $packageId): bool
    {
        $rating = $this->createQueryBuilder('c')
            ->andWhere('c.user = :user')
            ->andWhere('c.package = :packageId')
            ->setParameter('user', $user)
            ->setParameter('packageId', $packageId)
            ->getQuery()
            ->getOneOrNullResult()
        ;

        return null != $rating;
    }

    public function findAvgRatingForPackage($packageId): ?int
    {
        $qb = $this->createQueryBuilder('rating')
            ->andWhere('rating.package = :val')
            ->setParameter('val', $packageId)
        ;
        $result = $qb->getQuery()->getResult();
        if (0 == count($result)) {
            return null;
        }
        $avg = 0;
        foreach ($result as $row) {
            $avg += $row->getRating();
        }

        return round($avg / count($result));
    }
}
