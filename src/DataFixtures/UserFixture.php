<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    public const USER1_REFERENCE = 'user1';

    public const USER2_REFERENCE = 'user2';

    public const ADMIN_REFERENCE = 'admin';

    public function __construct(
        private readonly UserPasswordEncoderInterface $passwordEncoder
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $user1 = $this->createUser('Jan', 'Kowalski', 'jan_kowalski@dreamholiday.com');
        $this->addReference(self::USER1_REFERENCE, $user1);
        $manager->persist($user1);

        $user2 = $this->createUser('John', 'Cena', 'john_cena@holidaydream.com');
        $this->addReference(self::USER2_REFERENCE, $user2);
        $manager->persist($user2);

        $admin = $this->createAdmin('Jacob', 'Ćwikowski', 'kcwikowski007@gmail.com');
        $this->addReference(self::ADMIN_REFERENCE, $admin);
        $manager->persist($admin);

        $manager->flush();
    }

    private function createUser(string $firstName, string $lastName, string $email): User
    {
        $user = new User();
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setEmail($email);
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'password'));
        $user->setRegistrationDate(new \DateTime('now'));

        return $user;
    }

    private function createAdmin(string $firstName, string $lastName, string $email): User
    {
        $admin = $this->createUser($firstName, $lastName, $email);
        $admin->addRole('ROLE_ADMIN');

        return $admin;
    }
}
