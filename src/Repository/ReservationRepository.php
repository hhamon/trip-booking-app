<?php

namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Reservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservation[]    findAll()
 * @method Reservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    public function findReservationsByUser($user)
    {
        $reservations =  $this->createQueryBuilder('r')
            ->andWhere('r.user = :val')
            ->setParameter('val', $user)
            ->getQuery()
            ->getResult();
        foreach ($reservations as $reservation){
            $destination = $reservation->getBookingOffer()->getDestination();
            $offerPrice = $reservation->getBookingOffer()->getOfferPrice();
            $childPrice = $reservation->getBookingOffer()->getChildPrice();
            $reservation->setDestination($destination);
            $totalCost = $offerPrice*$reservation->getAdultNumber()+$childPrice*$reservation->getChildNumber();
            $reservation->setTotalCost($totalCost);
        }
        return $reservations;

    }
}
