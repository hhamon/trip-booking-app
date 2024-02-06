<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Career;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class CareerFixture extends Fixture
{
    #[\Override]
    public function load(ObjectManager $manager): void
    {
        $career = $this->createCareer(
            'manager',
            'Team management',
            '2 years experience',
            '4500.00',
            new \DateTime('-5 days'),
            new \DateTime('+12 months')
        );

        $manager->persist($career);

        $career = $this->createCareer(
            'tour guide',
            'Tour guidance',
            'Student status',
            '2000.00',
            new \DateTime('-12 days'),
            new \DateTime('+8 months')
        );

        $manager->persist($career);
        $manager->flush();
    }

    private function createCareer(
        string $jobTitle,
        string $description,
        string $requirements,
        string $salary,
        \DateTime $startDate,
        \DateTime $endDate,
    ): Career {
        $career = new Career();
        $career->setJobTitle($jobTitle);
        $career->setDescription($description);
        $career->setRequirements($requirements);
        $career->setSalary($salary);
        $career->setRecruitmentStartDate($startDate);
        $career->setRecruitmentEndDate($endDate);

        return $career;
    }
}
