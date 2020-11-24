<?php

namespace App\DataFixtures;

use App\Entity\Dentist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
        $dentist = new Dentist();

        $dentist->setTradename("Leslie Serret dentiste équin");
        $dentist->setSiret("110393927271122333");
        $dentist->setPassword($this->encoder->encodePassword($dentist, "password"));
        $dentist->setIsAdmin(false);
        $dentist->setName("Leslie");
        $dentist->setSurname("Serret");
        $dentist->setAddress("Rue de morlaix");
        $dentist->setPostalCode("29760");
        $dentist->setCity("MORLAIX");
        $dentist->setMail("leslie.serret@gmail.com");
        $dentist->setUsername("leslie29");
        $dentist->setRoles(['ROLE_DENTIST']);

        $manager->persist($dentist);

        $dentist = new Dentist();

        $dentist->setTradename("Administrateur");
        $dentist->setSiret("222299002929818272727271");
        $dentist->setPassword($this->encoder->encodePassword($dentist, "password"));
        $dentist->setIsAdmin(true);
        $dentist->setName("Aurélien");
        $dentist->setSurname("Dincuff");
        $dentist->setAddress("Rue de CLaire vue");
        $dentist->setPostalCode("22240");
        $dentist->setCity("FREHEL");
        $dentist->setMail("aurelien.dincuff@gmail.com");
        $dentist->setUsername("admin");
        $dentist->setRoles(['ROLE_ADMIN']);

        $manager->persist($dentist);
        $manager->flush();
    }
}
