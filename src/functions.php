<?php

declare(strict_types=1);

namespace App\Functions;

/**
 * Function to create an array for each dice number in saveddices
 *
 * @return array
 */
function arrayDiceNumbers(array $saveddices, int $number): array
{
    $findkeys = array_keys($saveddices, $number);

    $histogram = array();

    foreach ($findkeys as $key) {
        array_push($histogram, $saveddices[$key]);
    }

    return $histogram;
}
