<?php

namespace App\DataFixtures;

use App\Entity\Career;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CareerFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $career = $this->createCareer(
            'manager',
            'Team management',
            '2 years experience',
            4500.00,
            new \DateTime('2020-11-22'),
            new \DateTime('2020-12-30')
        );
        $manager->persist($career);
        $career = $this->createCareer(
            'tour guide',
            'Tour guidance',
            'Student status',
            2000.00,
            new \DateTime('2020-11-22'),
            new \DateTime('2020-12-30')
        );
        $manager->persist($career);
        $manager->flush();
    }

    private function createCareer($jobTitle, $description, $requirements, $salary, $startDate, $endDate)
    {
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
