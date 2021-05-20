<?php

declare(strict_types=1);

namespace App\Dice;

use App\Entity\Highscore;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GameHighscore as a controller class
 */
class GameHighscore
{
    public function processHighscore(EntityManagerInterface $entityManager, Request $request): void
    {
        $rounds = $request->request->get("rounds");
        $name = $request->request->get("name");
        $wins = $request->request->get("wins");
        $losses = $request->request->get("losses");
        $playercoins = $request->request->get("playercoins");
        $botcoins = $request->request->get("botcoins");
        $dicetotal = $request->request->get("dicetotal");

        $highscore = new Highscore();
        $highscore->setRoundTotal((int)$rounds);
        $highscore->setName($name);
        $highscore->setWin((int)$wins);
        $highscore->setLoss((int)$losses);
        $highscore->setPlayerCoin((int)$playercoins);
        $highscore->setBotCoin((int)$botcoins);
        $highscore->setDiceTotal((int)$dicetotal);

        $entityManager->persist($highscore);

        $entityManager->flush();
    }

    public function showHighscoreTable(EntityManagerInterface $entityManager): array
    {
        $data = array();

        $query = $entityManager->createQuery(
            'SELECT
                h.name,
                h.win,
                h.playerCoin
            FROM App\Entity\Highscore h 
            ORDER BY h.playerCoin DESC'
        );

        $data["highscore"] = $query->getResult();

        return $data;
    }

    public function showOverallStats(EntityManagerInterface $entityManager): array
    {
        $data = array();

        $query = $entityManager->createQuery(
            'SELECT 
                sum(h.roundTotal) AS roundtotal,
                sum(h.diceTotal) AS dicetotal,
                sum(h.loss) as losstotal,
                sum(h.win) as wintotal
            FROM App\Entity\Highscore h'
        );

        $data["getOverallStats"] = $query->getResult();

        return $data;
    }

    public function showPlayerStats(EntityManagerInterface $entityManager, string $name): array
    {
        $data = array();

        $query = $entityManager->createQuery(
            'SELECT 
                h.roundTotal AS roundtotal,
                h.name AS username,
                h.win AS win,
                h.loss AS loss,
                h.playerCoin AS playercoins,
                h.botCoin AS botcoins
            FROM App\Entity\Highscore h
            WHERE h.name = :name'
        )->setParameter('name', $name);

        $data["getPlayerStats"] = $query->getResult();

        return $data;
    }
}
