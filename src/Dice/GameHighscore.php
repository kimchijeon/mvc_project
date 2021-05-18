<?php

declare(strict_types=1);

namespace App\Dice;

use App\Dice\Dice;
use App\Dice\Dicehand;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use function App\Functions\arrayDiceNumbers;

/**
 * Class GameHighscore as a controller class
 */
class GameHighscore
{
    public function printHistogram(Request $request): array
    {
        $session = $request->getSession();

        $saveddices = $session->get("saveddices") ?? [0];

        $data["getOnes"] = arrayDiceNumbers($saveddices, 1);
        $data["getTwos"] = arrayDiceNumbers($saveddices, 2);
        $data["getThrees"] = arrayDiceNumbers($saveddices, 3);
        $data["getFours"] = arrayDiceNumbers($saveddices, 4);
        $data["getFives"] = arrayDiceNumbers($saveddices, 5);
        $data["getSixes"] = arrayDiceNumbers($saveddices, 6);

        return $data;
    }
}
