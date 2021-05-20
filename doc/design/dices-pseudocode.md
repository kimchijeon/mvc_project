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

## Method to save round dices into session
Set variable `saveddices` to session variable `saveddices`.

If `saveddices` is empty

	Set `saveddices` to `rounddices`.

If `saveddices` and `rounddices` are set

	Merge `saveddices` and `rounddices`.
	Set `saveddices` to the merge.

## Function to create an array for each dice number in saved dices
Find the keys in `saveddices` which has the wanted `number` and save them in `findkeys`.

Define `histogram` as an array.

For each key in `findkeys`

	Push the corresponding values in `saveddices` into `histogram`.