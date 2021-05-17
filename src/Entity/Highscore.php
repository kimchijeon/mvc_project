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
    private $rounds;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $wins;

    /**
     * @ORM\Column(type="integer")
     */
    private $losses;

    /**
     * @ORM\Column(type="integer")
     */
    private $player_coins;

    /**
     * @ORM\Column(type="integer")
     */
    private $bot_coins;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRounds(): ?int
    {
        return $this->rounds;
    }

    public function setRounds(int $rounds): self
    {
        $this->rounds = $rounds;

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

    public function getWins(): ?int
    {
        return $this->wins;
    }

    public function setWins(int $wins): self
    {
        $this->wins = $wins;

        return $this;
    }

    public function getLosses(): ?int
    {
        return $this->losses;
    }

    public function setLosses(int $losses): self
    {
        $this->losses = $losses;

        return $this;
    }

    public function getPlayerCoins(): ?int
    {
        return $this->player_coins;
    }

    public function setPlayerCoins(int $player_coins): self
    {
        $this->player_coins = $player_coins;

        return $this;
    }

    public function getBotCoins(): ?int
    {
        return $this->bot_coins;
    }

    public function setBotCoins(int $bot_coins): self
    {
        $this->bot_coins = $bot_coins;

        return $this;
    }
}
