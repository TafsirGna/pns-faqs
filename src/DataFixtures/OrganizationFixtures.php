<?php

namespace App\DataFixtures;

use App\Entity\Organization;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class OrganizationFixtures extends Fixture implements OrderedFixtureInterface 
{
    public function load(ObjectManager $manager)
    {
        $organizationsData = ["ASSI"];
        $length = sizeof($organizationsData);

        for ($i=0; $i < $length; $i++) { 
            # code...
            $organization = new Organization();
            $organization->setName($organizationsData[$i]);
            $manager->persist($organization);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}
