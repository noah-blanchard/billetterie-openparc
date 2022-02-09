<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource(
 *     forceEager=false,
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}}
 * )
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Court::class, inversedBy="reservations")
     * @Groups({"read"})
     */
    private $idCourt;

    /**
     * @ORM\ManyToOne(targetEntity=Rencontre::class, inversedBy="reservations")
     * @Groups({"read"})
     */
    private $idMatch;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"read"})
     */
    private $idJoueur;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"read"})
     */
    private $heure;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"read"})
     */
    private $minute;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"read"})
     */
    private $jour;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCourt(): ?Court
    {
        return $this->idCourt;
    }

    public function setIdCourt(?Court $idCourt): self
    {
        $this->idCourt = $idCourt;

        return $this;
    }

    public function getIdMatch(): ?Rencontre
    {
        return $this->idMatch;
    }

    public function setIdMatch(?Rencontre $idMatch): self
    {
        $this->idMatch = $idMatch;

        return $this;
    }

    public function getIdJoueur(): ?int
    {
        return $this->idJoueur;
    }

    public function setIdJoueur(?int $idJoueur): self
    {
        $this->idJoueur = $idJoueur;

        return $this;
    }

    public function getHeure(): ?int
    {
        return $this->heure;
    }

    public function setHeure(?int $heure): self
    {
        $this->heure = $heure;

        return $this;
    }

    public function getMinute(): ?int
    {
        return $this->minute;
    }

    public function setMinute(?int $minute): self
    {
        $this->minute = $minute;

        return $this;
    }

    public function getJour(): ?int
    {
        return $this->jour;
    }

    public function setJour(?int $jour): self
    {
        $this->jour = $jour;

        return $this;
    }
}
