<?php

declare(strict_types=1);

namespace App\Dice;

use App\Dice\Dice;
use App\Dice\Dicehand;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GameFinalResults as a controller class
 */
class GameFinalResults
{
    private $message;

    public function setTotals(Request $request): array
    {
        $session = $request->getSession();

        $data = [
            "header" => "Let's play 21",
            "message" => "Final results!",
        ];

        $playertotal = $session->get("playertotal");
        if (isset($playertotal)) {
            $data["getPlayerTotal"] = $playertotal;
        }

        $bottotal = $session->get("bottotal");
        if (isset($bottotal)) {
            $data["getBotTotal"] = $bottotal;
        }

        return $data;
    }

    public function showFinalResults(Request $request): array
    {
        $session = $request->getSession();

        $playertotal = $session->get("playertotal");
        $bottotal = $session->get("bottotal");

        $this->message = "";

        if ($playertotal > 21) {
            $this->message .= "You're both losers.";
        } elseif ($playertotal == 21 || $bottotal > 21) {
            $this->message .= "You win!";
        } elseif ($bottotal == $playertotal || $bottotal > $playertotal && $bottotal <= 21) {
            $this->message .= "Bot wins!";
        }

        $data["getResultMessage"] = $this->message;

        return $data;
    }

    public function showScoreboard(Request $request): array
    {
        $session = $request->getSession();

        $win = $session->get("win");
        $loss = $session->get("loss");

        if ($this->message == "You win!") {
            $win += 1;
            $session->set("win", $win);
        } elseif ($this->message == "Bot wins!") {
            $loss += 1;
            $session->set("loss", $loss);
        }

        $data["getWins"] = 0;

        if (isset($win)) {
            $data["getWins"] = $win;
        }

        $data["getLosses"] = 0;

        if (isset($loss)) {
            $data["getLosses"] = $loss;
        }

        return $data;
    }
}
