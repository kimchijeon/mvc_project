<?php

namespace App\Entity;

use App\Repository\HighscoreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HighscoreRepository::class)
 */
class Highscore
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $roundTotal;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $win;

    /**
     * @ORM\Column(type="integer")
     */
    private $loss;

    /**
     * @ORM\Column(type="integer")
     */
    private $playerCoin;

    /**
     * @ORM\Column(type="integer")
     */
    private $botCoin;

    /**
     * @ORM\Column(type="integer")
     */
    private $diceTotal;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoundTotal(): ?int
    {
        return $this->roundTotal;
    }

    public function setRoundTotal(int $roundTotal): self
    {
        $this->roundTotal = $roundTotal;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getWin(): ?int
    {
        return $this->win;
    }

    public function setWin(int $win): self
    {
        $this->win = $win;

        return $this;
    }

    public function getLoss(): ?int
    {
        return $this->loss;
    }

    public function setLoss(int $loss): self
    {
        $this->loss = $loss;

        return $this;
    }

    public function getPlayerCoin(): ?int
    {
        return $this->playerCoin;
    }

    public function setPlayerCoin(int $playerCoin): self
    {
        $this->playerCoin = $playerCoin;

        return $this;
    }

    public function getBotCoin(): ?int
    {
        return $this->botCoin;
    }

    public function setBotCoin(int $botCoin): self
    {
        $this->botCoin = $botCoin;

        return $this;
    }

    public function getDiceTotal(): ?int
    {
        return $this->diceTotal;
    }

    public function setDiceTotal(int $diceTotal): self
    {
        $this->diceTotal = $diceTotal;

        return $this;
    }
}
