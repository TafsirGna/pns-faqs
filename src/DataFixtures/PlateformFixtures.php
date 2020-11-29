<?php

namespace App\DataFixtures;

use App\Entity\Plateform;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PlateformFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $plateformsData = [
            [
                "name"  =>  "PNS",
            ]
        ];
        
        $length = sizeof($plateformsData);
        for ($i=0; $i < $length; $i++) { 
            # code...
            $plateform = new Plateform();
            $plateform->setName($plateformsData[$i]["name"]);
            $manager->persist($plateform);
        }

        $manager->flush();
    }
}
