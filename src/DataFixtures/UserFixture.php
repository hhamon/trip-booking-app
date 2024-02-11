<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserFixture extends Fixture
{
    public const string USER1_REFERENCE = 'user1';

    public const string USER2_REFERENCE = 'user2';

    public const string ADMIN_REFERENCE = 'admin';

    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher,
    ) {
    }

    #[\Override]
    public function load(ObjectManager $manager): void
    {
        $user1 = $this->createUser('John', 'Doe', 'john.doe@dreamholiday.com');
        $this->addReference(self::USER1_REFERENCE, $user1);
        $manager->persist($user1);

        $user2 = $this->createUser('Alice', 'Smith', 'alice.smith@holidaydream.com');
        $this->addReference(self::USER2_REFERENCE, $user2);
        $manager->persist($user2);

        $admin = $this->createAdmin('Super', 'Admin', 'super.admin@holidaydream.com');
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
        $user->setPassword($this->passwordHasher->hashPassword($user, 'password'));
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
