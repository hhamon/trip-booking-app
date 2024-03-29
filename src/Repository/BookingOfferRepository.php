<?php

namespace App\Repository;

use App\Entity\BookingOffer;
use App\Entity\CustomersRating;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Expr\CompositeExpression;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BookingOffer|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookingOffer|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookingOffer[]    findAll()
 * @method BookingOffer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingOfferRepository extends ServiceEntityRepository
{
    private readonly ManagerRegistry $registry;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookingOffer::class);

        $this->registry = $registry;
    }

    private function createSearchCriteria($departureSpot = null, $destination = null, $departureDate = null, $comebackDate = null, $priceMin = null, $priceMax = null, $bookingOfferTypes = null): Criteria
    {
        $currentDate = new \DateTime('now');
        $criteria = new Criteria();
        $criteria->andWhere(Criteria::expr()->gt('bookingEndDate', $currentDate));
        if ($departureSpot != null) {
            $criteria->andWhere(Criteria::expr()->eq('departureSpot', $departureSpot));
        }

        if ($destination != null) {
            $criteria->andWhere(Criteria::expr()->eq('destination', $destination));
        }

        if ($departureDate != null) {
            $criteria->andWhere(Criteria::expr()->gte('departureDate', $departureDate));
        }

        if ($comebackDate != null) {
            $criteria->andWhere(Criteria::expr()->lte('comebackDate', $comebackDate));
        }

        if ($priceMin != null) {
            $criteria->andWhere(Criteria::expr()->gte('offerPrice', $priceMin));
        }

        if ($priceMax != null) {
            $criteria->andWhere(Criteria::expr()->lte('offerPrice', $priceMax));
        }

        if ($bookingOfferTypes != null) {
            $orStatements = [];
            foreach ($bookingOfferTypes as $type) {
                $orStatements[] = Criteria::expr()->eq('offerType', $type);
            }

            if ($orStatements !== []) {
                $criteria->andWhere(new CompositeExpression(CompositeExpression::TYPE_OR, $orStatements));
            }
        }

        return $criteria;
    }

    public function findOffers($departureSpot = null, $destination = null, $departureDate = null, $comebackDate = null, $priceMin = null, $priceMax = null, $bookingOfferTypes = null)
    {
        $qb = $this->createQueryBuilder('offer')->addCriteria($this->createSearchCriteria($departureSpot, $destination, $departureDate, $comebackDate, $priceMin, $priceMax, $bookingOfferTypes));

        /** @var BookingOffer[] $result */
        $result = $qb->getQuery()->getResult();

        foreach ($result as $row) {
            $packageId = $row->getPackageId();

            if (\is_int($packageId)) {
                $row->setRating($this->findOfferRating($packageId));
            }
        }

        return $result;
    }

    public function findOffer($id): ?BookingOffer
    {
        $offer = $this->find($id);
        $rating = $this->findOfferRating($offer->getPackageId());
        $offer->setRating($rating);

        return $offer;
    }

    private function findOfferRating(int $packageId): ?int
    {
        return $this->registry->getRepository(CustomersRating::class)->findAvgRatingForPackage($packageId);
    }
}
