<?php

namespace App\DataFixtures;

use App\Entity\CustomersRating;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CustomersRatingFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $rating = $this->createRating(
            $this->getReference(UserFixture::USER1_REFERENCE),
            10,
            5
        );
        $manager->persist($rating);
        $rating = $this->createRatingWithComment(
            $this->getReference(UserFixture::USER1_REFERENCE),
            4,
            4,
            'Great tour'
        );
        $manager->persist($rating);
        $rating = $this->createRatingWithComment(
            $this->getReference(UserFixture::USER2_REFERENCE),
            9,
            3,
            'Accommodation could have been better'
        );
        $manager->persist($rating);

        $manager->flush();
    }

    private function createRating(?User $user, ?int $package_id, int $rating): CustomersRating
    {
        $customersRating = new CustomersRating();
        $customersRating->setUser($user);
        $customersRating->setPackage($package_id);
        $customersRating->setRating($rating);

        return $customersRating;
    }

    private function createRatingWithComment($user, int $package_id, int $rating, string $comment): CustomersRating
    {
        $customersRating = $this->createRating($user, $package_id, $rating);
        $customersRating->setComment($comment);

        return $customersRating;
    }

    public function getDependencies()
    {
        return [UserFixture::class, BookingOfferFixture::class];
    }
}
