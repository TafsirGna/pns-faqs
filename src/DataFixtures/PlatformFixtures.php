<?php

namespace App\DataFixtures;

use App\Entity\Platform;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PlatformFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $platformsData = [
        //     [
        //         "name"  =>  "PNS",
        //     ]
        // ];
        
        // $length = sizeof($platformsData);
        // for ($i=0; $i < $length; $i++) { 
        //     # code...
        //     $platform = new Platform();
        //     $platform->setName($platformsData[$i]["name"]);
        //     $manager->persist($platform);
        // }

        // $manager->flush();
    }
}
