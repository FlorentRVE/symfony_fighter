<?php

namespace App\Controller;

use App\Entity\Fight;
use App\Repository\UserChampionRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class DuelController extends AbstractController
{
    #[Route('/duel', name: 'app_duel')]
    public function index(UserRepository $userRepository, UserChampionRepository $userChampionRepository): JsonResponse
    {
        // $player1 = $this->getUser();
        $player1 = $userRepository->find(13); // ! test env

        $users = $userRepository->findOpponent($player1->getId());
        $player2 = $users[rand(0, count($users) - 1)];

        if($player1->getId() == $player2->getId() || $player2->getId() == 6){
            $player2 = $users[rand(0, count($users) - 1)];
        }

        $duo1 = $userChampionRepository->findByUserChampionId($player1->getId());
        $duo2 = $userChampionRepository->findByUserChampionId($player2->getId());

        $log = [];
        $winner = null;

        $log[] = "Le combat commence";
        $log[] = $player1->getUsername() . " vs " . $player2->getUsername();
        $log[] = "Joueur 1 commence avec " . $duo1->getPv() . " PV";
        $log[] = "Et " . $duo1->getPower() . " d'attaque";
        $log[] = "Joueur 2 commence avec " . $duo2->getPv() . " PV";
        $log[] = "Et " . $duo2->getPower() . " d'attaque";


        while ($duo1->getPv() > 0 && $duo2->getPv() > 0) {            

            $duo2->setPv($duo2->getPv() - rand(10,$duo1->getPower()));
            $log[] = "Joueur 1 inflige un dommage de " . rand(10,$duo1->getPower()) . " au Joueur 2";
            $log[] = "Il lui reste " . $duo2->getPv() . " PV";

            $duo1->setPv($duo1->getPv() - rand(10,$duo2->getPower()));
            $log[] = "Joueur 2 inflige un dommage de " . rand(10,$duo2->getPower()) . " au Joueur 1";
            $log[] = "Il lui reste " . $duo1->getPv() . " PV";

            if($duo1->getPv() <= 0){
                $log[] = $player2->getUsername().' gagne';
                $winner = $player2;
            }

            if($duo2->getPv() <= 0){
                $log[] = $player1->getUsername().' gagne';
                $winner = $player1;
            }            
        }

        $result = new Fight();
        $result->setUser1($player1);
        $result->setUser2($player2);
        $result->setWinner($winner);
        $result->setCreatedAt(new \DateTimeImmutable());

        return $this->json([
            'log' => $log,
        ]);
    }
}
