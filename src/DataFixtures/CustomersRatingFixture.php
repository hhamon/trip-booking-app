<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\CustomersRating;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class CustomersRatingFixture extends Fixture implements DependentFixtureInterface
{
    #[\Override]
    public function load(ObjectManager $manager): void
    {
        $manager->persist($this->createCustomerRating(UserFixture::USER1_REFERENCE, 10, 5));
        $manager->persist($this->createCustomerRating(UserFixture::USER1_REFERENCE, 4, 4, 'Great tour'));
        $manager->persist($this->createCustomerRating(UserFixture::USER2_REFERENCE, 9, 3, 'Accommodation could have been better'));

        $manager->flush();
    }

    /**
     * @return class-string[]
     */
    #[\Override]
    public function getDependencies(): array
    {
        return [UserFixture::class, BookingOfferFixture::class];
    }

    private function createCustomerRating(string $userKey, int $packageId, int $rating, ?string $comment = null): CustomersRating
    {
        return CustomersRating::authoredBy($this->getUser($userKey), $packageId, $rating, $comment);
    }

    private function getUser(string $referenceKey): User
    {
        $user = $this->getReference($referenceKey);
        \assert($user instanceof User);

        return $user;
    }
}
