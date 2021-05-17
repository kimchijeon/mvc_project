<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Dice\Game;
use App\Dice\GamePrepare;
use App\Dice\GameResults;
use App\Dice\GameFinalResults;


class Game21Controller extends AbstractController
{
    /**
     * @Route("/game21", name="game21")
    */
    public function index(Request $request): Response
    {
        $data = [
            "header" => "Let's play 21",
            "message" => "Can you beat me in a game of 21?",
        ];

        $callable = new GamePrepare();
        $callable->prepareGame($request);

        return $this->render('game21/index.html.twig', $data);
    }

    /**
     * @Route("/game21/process", name="game21_process")
    */
    public function setDiceProcess(Request $request): Response
    {
        $callable = new GamePrepare();
        $callable->setDiceNumber($request);

        return $this->redirectToRoute('game21_game');
    }

    /**
     * @Route("/game21/game", name="game21_game")
    */
    public function game(Request $request): Response
    {
        $callable = new GameResults();
        $data = $callable->showResults($request);

        return $this->render('game21/game.html.twig', $data);
    }

    /**
     * @Route("/game21/play", name="game21_play")
    */
    public function play(Request $request): Response
    {
        $callable = new Game();
        $callable->playGame($request);

        return $this->redirectToRoute('game21_game');
    }

    /**
     * @Route("/game21/bot/process", name="game21_bot_process")
    */
    public function botProcess(Request $request): Response
    {
        $callable = new Game();
        $callable->savePlayerTotal($request);

        return $this->redirectToRoute('game21_bot_game');
    }

    /**
     * @Route("/game21/bot/game", name="game21_bot_game")
    */
    public function botGame(Request $request): Response
    {
        $callable = new Game();
        $data = $callable->prepareBotGame($request);

        return $this->render('game21/botgame.html.twig', $data);
    }

    /**
     * @Route("/game21/bot/play", name="game21_bot_play")
    */
    public function botPlay(Request $request): Response
    {
        $callable = new Game();
        $callable->botRoll($request);

        return $this->redirectToRoute('game21_result');
    }

    /**
     * @Route("/game21/result", name="game21_result")
    */
    public function result(Request $request): Response
    {
        $callable = new GameFinalResults();
        $totals = $callable->setTotals($request);
        $results = $callable->showFinalResults($request);
        $scoreboard = $callable->showScoreboard($request);

        $data = $totals + $results + $scoreboard;

        return $this->render('game21/result.html.twig', $data);
    }

    /**
     * @Route("/game21/restart", name="game21_restart")
    */
    public function restart(Request $request): Response
    {
        $session = $request->getSession();
        $session->clear();

        return $this->redirectToRoute('game21');
    }
}
