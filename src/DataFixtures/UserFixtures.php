<?php

namespace App\DataFixtures;

use App\Entity\Champion;
use App\Entity\User;
use App\Entity\UserChampion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $admin = new User();
        $admin->setEmail("testAdmin@gmail.com")
            ->setPassword(password_hash("password", PASSWORD_DEFAULT))
            ->setUsername("testAdmin")
            ->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);
        
        // ======= Create a new user
        $user1 = new User();
        $user1->setEmail("User1@gmail.com");
        $user1->setPassword(password_hash("password", PASSWORD_DEFAULT));
        $user1->setUsername("User1");
        $user1->setRoles(['ROLE_USER']);
        $manager->persist($user1);
        
        $champions = $manager->getRepository(Champion::class)->findAll();
        $randomChampion = $champions[rand(0, count($champions) - 1)];
        $randomPv = rand(200, $randomChampion->getPv());
        $randomPower = rand(30, $randomChampion->getPower());
      
        $linkUserChampion = new UserChampion();
        $linkUserChampion->setUser($user1);
        $linkUserChampion->setChampion($randomChampion);
        $linkUserChampion->setPv($randomPv);
        $linkUserChampion->setPower($randomPower);
        $manager->persist($linkUserChampion);

        // ====== Create a new user  
        $user2 = new User();
        $user2->setEmail("User2@gmail.com");
        $user2->setPassword(password_hash("password", PASSWORD_DEFAULT));
        $user2->setUsername("User2");
        $user2->setRoles(['ROLE_USER']);
        $manager->persist($user2);
        
        $champions = $manager->getRepository(Champion::class)->findAll();
        $randomChampion = $champions[rand(0, count($champions) - 1)];
        $randomPv = rand(200, $randomChampion->getPv());
        $randomPower = rand(30, $randomChampion->getPower());

        $linkUserChampion = new UserChampion();
        $linkUserChampion->setUser($user2);
        $linkUserChampion->setChampion($randomChampion);
        $linkUserChampion->setPv($randomPv);
        $linkUserChampion->setPower($randomPower);
        $manager->persist($linkUserChampion);

        $manager->flush();
    }
}
