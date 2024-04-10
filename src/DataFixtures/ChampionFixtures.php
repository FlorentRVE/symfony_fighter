<?php

namespace App\DataFixtures;

use App\Entity\Champion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ChampionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $axe = new Champion();
        $axe->setName('Axe');
        $axe->setPv(500);
        $axe->setPower(80);
        $manager->persist($axe);
        
        $rhasta = new Champion();
        $rhasta->setName('Rhasta');
        $rhasta->setPv(400);
        $rhasta->setPower(40);
        $manager->persist($rhasta);
        
        $jakiro = new Champion();
        $jakiro->setName('Jakiro');
        $jakiro->setPv(550);
        $jakiro->setPower(60);
        $manager->persist($jakiro);
        
        $redwin = new Champion();
        $redwin->setName('Redwin');
        $redwin->setPv(800);
        $redwin->setPower(100);
        $manager->persist($redwin);

        $chaobla = new Champion();
        $chaobla->setName('Chaobla');
        $chaobla->setPv(600);
        $chaobla->setPower(90);
        $manager->persist($chaobla);

        $manager->flush();
    }
}
