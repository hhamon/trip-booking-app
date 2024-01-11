<?php

namespace App\Repository;

use App\Entity\BookingOfferType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BookingOfferType|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookingOfferType|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookingOfferType[]    findAll()
 * @method BookingOfferType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingOfferTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookingOfferType::class);
    }
}
