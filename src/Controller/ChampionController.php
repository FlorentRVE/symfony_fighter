<?php

namespace App\Controller;

use App\Entity\Champion;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/champion')]
class ChampionController extends AbstractController
{   
    #[Route('/create', name: 'app_champion_create', methods: ['POST'])]
    public function createChampion(Request $request, EntityManagerInterface $manager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $champion = new Champion();
        $champion->setName($data['name']);
        $champion->setPv($data['pv']);
        $champion->setPower($data['power']);
        $manager->persist($champion);
        $manager->flush();
        
        return $this->json([
            'message' => 'Champion created !',
        ]);
    }
}
