Pseudo code for Round Dices and Saved Dices
===========================================
Following code is implemented after a call to `Game`-class method `playGame()`.

## Method for saving round dices

Set variable `dicehand` to session variable `dicehand`.

Set variable `rounddices` to session variable `rounddices`.

If `rounddices` is empty

    Set `rounddices` to `dicehand`.
else

    Set `rounddices` to `array_merge` of `rounddices` and `dicehand`.

## Show saved dices in a histogram
