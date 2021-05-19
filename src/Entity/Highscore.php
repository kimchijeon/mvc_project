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
    private $round_total;

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
    private $player_coin;

    /**
     * @ORM\Column(type="integer")
     */
    private $bot_coin;

    /**
     * @ORM\Column(type="integer")
     */
    private $dice_total;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoundTotal(): ?int
    {
        return $this->round_total;
    }

    public function setRoundTotal(int $round_total): self
    {
        $this->round_total = $round_total;

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
        return $this->player_coin;
    }

    public function setPlayerCoin(int $player_coin): self
    {
        $this->player_coin = $player_coin;

        return $this;
    }

    public function getBotCoin(): ?int
    {
        return $this->bot_coin;
    }

    public function setBotCoin(int $bot_coin): self
    {
        $this->bot_coin = $bot_coin;

        return $this;
    }

    public function getDiceTotal(): ?int
    {
        return $this->dice_total;
    }

    public function setDiceTotal(int $dice_total): self
    {
        $this->dice_total = $dice_total;

        return $this;
    }
}
