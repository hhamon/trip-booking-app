<?php


namespace App\DataFixtures;

use App\Entity\CustomersRating;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CustomersRatingFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
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

    private function createRating($user, $package_id, $rating) :CustomersRating
    {
        $customersRating = new CustomersRating();
        $customersRating->setUser($user);
        $customersRating->setPackage($package_id);
        $customersRating->setRating($rating);
        return $customersRating;
    }

    private function createRatingWithComment($user, $package_id, $rating, $comment) :CustomersRating
    {
        $customersRating= $this->createRating($user, $package_id, $rating);
        $customersRating->setComment($comment);
        return $customersRating;
    }

    public function getDependencies()
    {
        return [UserFixture::class, BookingOfferFixture::class];
    }
}