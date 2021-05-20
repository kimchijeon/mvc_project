<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Dice\GameHighscore;
use Doctrine\ORM\EntityManagerInterface;

class HighscoreController extends AbstractController
{
    /**
     * @Route("/game21/highscore", name="highscore")
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $callable = new GameHighscore();
        $highscore = $callable->showHighscoreTable($entityManager);
        $overallstats = $callable->showOverallStats($entityManager);


        $data = $highscore + $overallstats;
        return $this->render('game21/highscore.html.twig', $data);
    }

    /**
     * @Route("/game21/highscore/process", name="highscore_process")
     */
    public function process(EntityManagerInterface $entityManager, Request $request): Response
    {
        $callable = new GameHighscore();
        $callable->processHighscore($entityManager, $request);

        return $this->redirectToRoute('highscore');
    }

    /**
     * @Route("/game21/highscore/name/{name}", name="highscore_player")
     */
    public function showPlayer(EntityManagerInterface $entityManager, $name): Response
    {
        $callable = new GameHighscore();
        $data = $callable->showPlayerStats($entityManager, $name);

        return $this->render('game21/highscore-player.html.twig', $data);
    }
}
