<?php

declare(strict_types=1);

namespace App\Dice;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

use function App\Functions\arrayDiceNumbers;

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
            "message" => "Round results!"
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
        $data = array();
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

    public function showBettingResults(Request $request): array
    {
        $data = array();
        $session = $request->getSession();

        $playercoins = $session->get("playercoins");
        $botcoins = $session->get("botcoins");
        $playerbet = $session->get("playerbet");

        if ($this->message == "You win!") {
            $playercoins = $playercoins + $playerbet;
            $session->set("playercoins", $playercoins);

            $botcoins = $botcoins - $playerbet;
            $session->set("botcoins", $botcoins);
        } elseif ($this->message == "Bot wins!") {
            $playercoins = $playercoins - $playerbet;
            $session->set("playercoins", $playercoins);

            $botcoins = $botcoins + $playerbet;
            $session->set("botcoins", $botcoins);
        }

        if (isset($playercoins) && isset($botcoins)) {
            $data["getPlayerCoins"] = $playercoins;
            $data["getBotCoins"] = $botcoins;
        }

        return $data;
    }

    public function showScoreboard(Request $request): array
    {
        $data = array();
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

    public function printHistogram(Request $request): array
    {
        $data = array();
        $session = $request->getSession();

        $saveddices = $session->get("saveddices") ?? [0];

        $data["getOnes"] = arrayDiceNumbers($saveddices, 1);
        $data["getTwos"] = arrayDiceNumbers($saveddices, 2);
        $data["getThrees"] = arrayDiceNumbers($saveddices, 3);
        $data["getFours"] = arrayDiceNumbers($saveddices, 4);
        $data["getFives"] = arrayDiceNumbers($saveddices, 5);
        $data["getSixes"] = arrayDiceNumbers($saveddices, 6);

        $data["getDiceTotal"] = count($data["getOnes"]) + count($data["getTwos"]) + count($data["getThrees"]) + count($data["getFours"]) + count($data["getFives"]) + count($data["getSixes"]);

        return $data;
    }
}
