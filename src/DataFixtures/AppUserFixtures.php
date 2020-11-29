<?php

namespace App\DataFixtures;

use App\Entity\AppUser;
use App\Entity\Organization;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class AppUserFixtures extends Fixture implements OrderedFixtureInterface 
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $appUsersData = [
            [
                "firstname" =>  "Tafsir",
                "lastname"  =>  'GNA',
                "organization"  =>  "ASSI",
                "email" =>  "tgna@presidence.bj",
                "password" =>  "tgna",
            ]
        ];

        $appUser = new AppUser();
        $length = sizeof($appUsersData);

        for ($i=0; $i < $length; $i++) { 
            # code...
            $appUser = new AppUser();
            $appUser->setEmail($appUsersData[$i]["email"]);
            $appUser->setFirstname($appUsersData[$i]["firstname"]);
            $appUser->setLastname($appUsersData[$i]["lastname"]);
            $organization = $manager->getRepository(Organization::class)->findOneBy(["name"  =>  $appUsersData[$i]["organization"]]);
            $appUser->setOrganization($organization);

            $appUser->setPassword($this->passwordEncoder->encodePassword(
                             $appUser,
                             $appUsersData[$i]["password"]
                         ));

            $manager->persist($appUser);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}
