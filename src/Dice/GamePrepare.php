<?php

declare(strict_types=1);

namespace App\Dice;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GamePrepare as a controller class
 */
class GamePrepare
{
    public function setDiceNumber(Request $request): void
    {
        $session = $request->getSession();

        $submit = $request->request->get("submit");
        $number = $request->request->get("number");

        if (isset($submit)) {
            $session->set("number", (int)$number);
        }
    }

    public function prepareGame(Request $request): void
    {
        $session = $request->getSession();

        $number = $session->get("number");
        if (isset($number)) {
            $session->set("number", null);
        }

        $dicehand = $session->get("dicehand");
        if (isset($dicehand)) {
            $session->set("dicehand", null);
        }

        $dicetotal = $session->get("dicetotal");
        if (isset($dicetotal)) {
            $session->set("dicetotal", null);
        }

        $playertotal = $session->get("playertotal");
        if (isset($playertotal)) {
            $session->set("playertotal", null);
        }

        $bothand = $session->get("bothand");
        if (isset($bothand)) {
            $session->set("bothand", null);
        }

        $bottotal = $session->get("bottotal");
        if (isset($bottotal)) {
            $session->set("bottotal", null);
        }

        $rounddices = $session->get("rounddices");
        if (isset($rounddices)) {
            $session->set("rounddices", null);
        }
    }

    public function saveRoundDices(Request $request): void
    {
        $session = $request->getSession();

        $rounddices = $session->get("rounddices");
        $saveddices = $session->get("saveddices");

        if (!isset($saveddices)) {
            $session->set("saveddices", $rounddices);
        }

        if (isset($saveddices) && isset($rounddices)) {
            $merge = array_merge($saveddices, $rounddices);
            $session->set("saveddices", $merge);
        }
    }
}
