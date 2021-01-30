<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\Horse;
use App\Repository\CustomerRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class HorseFixtures extends Fixture
{

    private CustomerRepository $customerRepo;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepo = $customerRepository;
    }

    public function load(ObjectManager $manager)
    {

        for ($i = 0; $i <= 5; $i++) {
            $horse = new Horse();
            $horse->setSire('15195278S');
            $horse->setName('Filou de Kerduff');
            $horse->setDateOfBirth(new \DateTime('2015/04/16'));
            $horse->setOwner($this->customerRepo->find(rand(1, 3)));

            $manager->persist($horse);
        }

        $manager->flush();
    }
}
