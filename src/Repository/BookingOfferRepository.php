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
    public function __construct(
        private readonly ManagerRegistry $registry,
    ) {
        parent::__construct($registry, BookingOffer::class);
    }

    private static function createSearchCriteria($departureSpot = null, $destination = null, $departureDate = null, $comebackDate = null, $priceMin = null, $priceMax = null, $bookingOfferTypes = null)
    {
        $currentDate = new \DateTime('now');
        $criteria = new Criteria();
        $criteria->andWhere(Criteria::expr()->gt('bookingEndDate', $currentDate));
        if (null != $departureSpot) {
            $criteria->andWhere(Criteria::expr()->eq('departureSpot', $departureSpot));
        }
        if (null != $destination) {
            $criteria->andWhere(Criteria::expr()->eq('destination', $destination));
        }
        if (null != $departureDate) {
            $criteria->andWhere(Criteria::expr()->gte('departureDate', $departureDate));
        }
        if (null != $comebackDate) {
            $criteria->andWhere(Criteria::expr()->lte('comebackDate', $comebackDate));
        }
        if (null != $priceMin) {
            $criteria->andWhere(Criteria::expr()->gte('offerPrice', $priceMin));
        }
        if (null != $priceMax) {
            $criteria->andWhere(Criteria::expr()->lte('offerPrice', $priceMax));
        }
        if (null != $bookingOfferTypes) {
            $orStatements = [];
            foreach ($bookingOfferTypes as $type) {
                $orStatements[] = Criteria::expr()->eq('offerType', $type);
            }
            if (!empty($orStatements)) {
                $criteria->andWhere(new CompositeExpression(CompositeExpression::TYPE_OR, $orStatements));
            }
        }

        return $criteria;
    }

    /**
     * @return array<string, string>
     */
    public function findDistinctDepartureSpots(): array
    {
        $qb = $this->createQueryBuilder('bookingOffer');

        $query = $qb->select('bookingOffer.departureSpot')
            ->distinct()
            ->orderBy('bookingOffer.departureSpot', 'ASC')
            ->groupBy('bookingOffer.departureSpot')
            ->getQuery()
        ;

        /** @var array<int, array{departureSpot: string}> $results */
        $results = $query->getResult();

        $departureSpots = \array_column($results, 'departureSpot');

        return \array_combine($departureSpots, $departureSpots);
    }

    /**
     * @param mixed|null $departureSpot
     * @param mixed|null $destination
     * @param mixed|null $departureDate
     * @param mixed|null $comebackDate
     * @param mixed|null $priceMin
     * @param mixed|null $priceMax
     * @param mixed|null $bookingOfferTypes
     *
     * @return iterable<int, BookingOffer>
     */
    public function findOffers(
        $departureSpot = null,
        $destination = null,
        $departureDate = null,
        $comebackDate = null,
        $priceMin = null,
        $priceMax = null,
        $bookingOfferTypes = null,
    ): iterable {
        $qb = $this->createQueryBuilder('offer')->addCriteria(self::createSearchCriteria(
            $departureSpot,
            $destination,
            $departureDate,
            $comebackDate,
            $priceMin,
            $priceMax,
            $bookingOfferTypes
        ));

        $result = $qb->getQuery()->getResult();
        \assert(\is_array($result));

        /** @var BookingOffer $row */
        foreach ($result as $row) {
            $row->setRating($this->findOfferRating((int) $row->getPackageId()));
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
