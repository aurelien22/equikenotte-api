<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\Dentist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;

class DentistFixtures extends Fixture
{

    /**
     * Encodeur de mot de passe
     * @var UserPasswordEncoderInterface
     */
    private UserPasswordEncoderInterface $encoder;

    /**
     * DentistFixtures constructor.
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $dentist1 = new Dentist();

        $dentist1->setTradename("Leslie Serret dentiste équin");
        $dentist1->setSiret("110393927271122333");
        $dentist1->setPassword($this->encoder->encodePassword($dentist1, "password"));
        $dentist1->setName("Leslie");
        $dentist1->setSurname("Serret");
        $dentist1->setAddress("Rue de morlaix");
        $dentist1->setPostalCode("29760");
        $dentist1->setCity("MORLAIX");
        $dentist1->setMail("leslie.serret@gmail.com");
        $dentist1->setUsername("leslie29");
        $dentist1->setRoles(['ROLE_DENTIST']);

        $manager->persist($dentist1);

        $dentist = new Dentist();

        $dentist->setTradename("Administrateur");
        $dentist->setSiret("222299002929818272727271");
        $dentist->setPassword($this->encoder->encodePassword($dentist, "password"));
        $dentist->setName("Aurélien");
        $dentist->setSurname("Dincuff");
        $dentist->setAddress("Rue de CLaire vue");
        $dentist->setPostalCode("22240");
        $dentist->setCity("FREHEL");
        $dentist->setMail("aurelien.dincuff@gmail.com");
        $dentist->setUsername("admin");
        $dentist->setRoles(['ROLE_ADMIN']);

        $manager->persist($dentist);

        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i <= 5; $i++) {
            $customer = new Customer();
            $customer->setName($faker->firstName);
            $customer->setSurname($faker->lastName);
            $customer->setAddress($faker->streetAddress);
            $customer->setPostalCode(str_replace(" ", "", $faker->postcode));
            $customer->setCity($faker->city);
            $customer->setPhone("0607985673");
            $customer->setMail($faker->email);
            $customer->setDentist($dentist1);

            $manager->persist($customer);
        }
        $manager->flush();
    }
}
