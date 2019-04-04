<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LogRepository")
 */
class Log
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userId;

    /**
     * @ORM\Column(type="integer")
     */
    private $brief_nr;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datum;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $chauffeurId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Truck")
     * @ORM\JoinColumn(nullable=false)
     */
    private $truckId;

    /**
     * @ORM\Column(type="float")
     */
    private $kubs;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $laadplaats;

    /**
     * @ORM\Column(type="datetime")
     */
    private $vertrektijd;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bestemming;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $evenement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getBriefNr(): ?int
    {
        return $this->brief_nr;
    }

    public function setBriefNr(int $brief_nr): self
    {
        $this->brief_nr = $brief_nr;

        return $this;
    }

    public function getDatum(): ?\DateTimeInterface
    {
        return $this->datum;
    }

    public function setDatum(\DateTimeInterface $datum): self
    {
        $this->datum = $datum;

        return $this;
    }

    public function getChauffeurId(): ?User
    {
        return $this->chauffeurId;
    }

    public function setChauffeurId(?User $chauffeurId): self
    {
        $this->chauffeurId = $chauffeurId;

        return $this;
    }

    public function getTruckId(): ?Truck
    {
        return $this->truckId;
    }

    public function setTruckId(?Truck $truckId): self
    {
        $this->truckId = $truckId;

        return $this;
    }

    public function getKubs(): ?float
    {
        return $this->kubs;
    }

    public function setKubs(float $kubs): self
    {
        $this->kubs = $kubs;

        return $this;
    }

    public function getLaadplaats(): ?string
    {
        return $this->laadplaats;
    }

    public function setLaadplaats(string $laadplaats): self
    {
        $this->laadplaats = $laadplaats;

        return $this;
    }

    public function getVertrektijd(): ?\DateTimeInterface
    {
        return $this->vertrektijd;
    }

    public function setVertrektijd(\DateTimeInterface $vertrektijd): self
    {
        $this->vertrektijd = $vertrektijd;

        return $this;
    }

    public function getBestemming(): ?string
    {
        return $this->bestemming;
    }

    public function setBestemming(string $bestemming): self
    {
        $this->bestemming = $bestemming;

        return $this;
    }

    public function getEvenement(): ?string
    {
        return $this->evenement;
    }

    public function setEvenement(?string $evenement): self
    {
        $this->evenement = $evenement;

        return $this;
    }
}
