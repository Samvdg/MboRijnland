<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocatieRepository")
 */
class Locatie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $breedtegraad;

    /**
     * @ORM\Column(type="float")
     */
    private $lengtegraad;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBreedtegraad(): ?int
    {
        return $this->breedtegraad;
    }

    public function setBreedtegraad(int $breedtegraad): self
    {
        $this->breedtegraad = $breedtegraad;

        return $this;
    }

    public function getLengtegraad(): ?float
    {
        return $this->lengtegraad;
    }

    public function setLengtegraad(float $lengtegraad): self
    {
        $this->lengtegraad = $lengtegraad;

        return $this;
    }
}
