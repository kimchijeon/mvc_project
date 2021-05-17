Pseudo code Game 21 betting
====================

## Setup at start of round
Set session variable `playercoins` to `10`.

Set session variable `botcoins` to `100`.

## Placing a bet
Player inputs number of coins to bet in a POST-form,
where the input max limit is ``playercoins` / 2`.

Set variable `playerbet` to above input.

## Removing/adding bets process
If `message` is `You win!`

    Set session variable ``playercoins`` to (``playercoins`` + `playerbet`).
    Set session variable `botcoins` to (`playercoins` - `playerbet`).

If `message` is `Bot wins!`

    Set session variable `playercoins` to (`playercoins` - `playerbet`).
    Set session variable `botcoins` to (`playercoins` + `playerbet`).

## Display coins
Set data array key `getPlayerCoins` with value `playerbitcoins`.