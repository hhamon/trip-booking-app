<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Newsletter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class NewsletterFixture extends Fixture
{
    #[\Override]
    public function load(ObjectManager $manager): void
    {
        $manager->persist($this->createNewsletter('john_cena@holidaydream.com'));
        $manager->persist($this->createNewsletter('marta@mazurkiewi.cz'));

        $manager->flush();
    }

    private function createNewsletter(string $email): Newsletter
    {
        $newsletter = new Newsletter();
        $newsletter->setEmail($email);

        return $newsletter;
    }
}
