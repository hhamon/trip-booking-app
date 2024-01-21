<?php

namespace App\DataFixtures;

use App\Entity\Newsletter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class NewsletterFixture extends Fixture
{
    #[\Override]
    public function load(ObjectManager $manager)
    {
        $manager->persist($this->createNewsletter('john_cena@holidaydream.com'));
        $manager->persist($this->createNewsletter('marta@mazurkiewi.cz'));

        $manager->flush();
    }

    private function createNewsletter($email)
    {
        $newsletter = new Newsletter();
        $newsletter->setEmail($email);

        return $newsletter;
    }
}
