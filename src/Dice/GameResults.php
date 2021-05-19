<?php

declare(strict_types=1);

namespace App\Dice;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GameResults as a controller class
 */
class GameResults
{
    public function showResults(Request $request): array
    {
        $session = $request->getSession();

        $data = [
            "header" => "Let's play 21",
            "message" => "If you get 21 you win! If you get more than 21 you lose."
        ];

        $dicetotal = $session->get("dicetotal");
        if (isset($dicetotal)) {
            $diceSession = $dicetotal;
        }

        $data["sumDice"] = 0;

        if (isset($diceSession)) {
            $data["sumDice"] = $diceSession;
        }

        $data["notice"] = "Keep rolling?";

        if (isset($diceSession) && $diceSession > 21) {
            $data["notice"] = "You lose!";
        } elseif (isset($diceSession) && $diceSession == 21) {
            $data["notice"] = "You win!";
        }

        $data["lastRoll"] = [0];
        $dicehand = $session->get("dicehand");

        if (isset($dicehand)) {
            $data["lastRoll"] = $dicehand;
        }

        return $data;
    }
}
