<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\JoueurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource(
 *     forceEager=false,
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}}
 * )
 * @ORM\Entity(repositoryClass=JoueurRepository::class)
 */
class Joueur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read"})
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read"})
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read"})
     */
    private $pays;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    private $classement;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read"})
     */
    private $groupe;

    // /**
    //  * @ORM\OneToMany(targetEntity=Reservation::class, mappedBy="idJoueur")
    //  * @Groups({"read"})
    //  */
    // private $reservations;

 

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getClassement(): ?int
    {
        return $this->classement;
    }

    public function setClassement(int $classement): self
    {
        $this->classement = $classement;

        return $this;
    }

    public function getGroupe(): ?string
    {
        return $this->groupe;
    }

    public function setGroupe(string $groupe): self
    {
        $this->groupe = $groupe;

        return $this;
    }

    // /**
    //  * @return Collection|Reservation[]
    //  */
    // public function getReservations(): Collection
    // {
    //     return $this->reservations;
    // }

    // public function addReservation(Reservation $reservation): self
    // {
    //     if (!$this->reservations->contains($reservation)) {
    //         $this->reservations[] = $reservation;
    //         $reservation->setIdJoueur($this->id);
    //     }

    //     return $this;
    // }

    // public function removeReservation(Reservation $reservation): self
    // {
    //     if ($this->reservations->removeElement($reservation)) {
    //         // set the owning side to null (unless already changed)
    //         if ($reservation->getIdJoueur() === $this->id) {
    //             $reservation->setIdJoueur(null);
    //         }
    //     }

    //     return $this;
    // }

}
