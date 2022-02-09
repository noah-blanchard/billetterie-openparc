<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RencontreRepository;
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
 * 
 * @ORM\Entity(repositoryClass=RencontreRepository::class)
 */
class Rencontre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Planning::class, inversedBy="matchs")
     * @Groups({"read"})
     */
    private $idPlanning;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read"})
     */
    private $etape;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"read"})
     */
    private $idVainqueur;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"read"})
     */
    private $idPerdant;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read"})
     */
    private $score;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups({"read"})
     */
    private $estDouble;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"read"})
     */
    private $idJoueur1;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"read"})
     */
    private $idJoueur2;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"read"})
     */
    private $idEquipe1;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"read"})
     */
    private $idEquipe2;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"read"})
     */
    private $idEquipeRamasseurs;

    /**
     * @ORM\ManyToMany(targetEntity=Arbitre::class, inversedBy="rencontresArbitrees")
     * @Groups({"read"})
     */
    private $arbitres;

    /**
     * @ORM\ManyToOne(targetEntity=Arbitre::class)
     * @Groups({"read"})
     */
    private $arbitreChaise;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"read"})
     */
    private $reservations;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    private $idEquipeRamasseurs2;

    /**
     * @ORM\OneToMany(targetEntity=ReservPlace::class, mappedBy="rencontre")
     * @Groups({"read", "write"})
     */
    private $placesReservees;

    

    public function __construct()
    {
        $this->arbitres = new ArrayCollection();
        $this->placesReservees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPlanning(): ?Planning
    {
        return $this->idPlanning;
    }

    public function setIdPlanning(?Planning $idPlanning): self
    {
        $this->idPlanning = $idPlanning;

        return $this;
    }

    public function getEtape(): ?string
    {
        return $this->etape;
    }

    public function setEtape(string $etape): self
    {
        $this->etape = $etape;

        return $this;
    }

    public function getIdVainqueur(): ?int
    {
        return $this->idVainqueur;
    }

    public function setIdVainqueur(?int $idVainqueur): self
    {
        $this->idVainqueur = $idVainqueur;

        return $this;
    }

    public function getIdPerdant(): ?int
    {
        return $this->idPerdant;
    }

    public function setIdPerdant(?int $idPerdant): self
    {
        $this->idPerdant = $idPerdant;

        return $this;
    }

    public function getScore(): ?string
    {
        return $this->score;
    }

    public function setScore(?string $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getEstDouble(): ?bool
    {
        return $this->estDouble;
    }

    public function setEstDouble(?bool $estDouble): self
    {
        $this->estDouble = $estDouble;

        return $this;
    }

    public function getIdJoueur1(): ?int
    {
        return $this->idJoueur1;
    }

    public function setIdJoueur1(?int $idJoueur1): self
    {
        $this->idJoueur1 = $idJoueur1;

        return $this;
    }

    public function getIdJoueur2(): ?int
    {
        return $this->idJoueur2;
    }

    public function setIdJoueur2(?int $idJoueur2): self
    {
        $this->idJoueur2 = $idJoueur2;

        return $this;
    }

    public function getIdEquipe1(): ?int
    {
        return $this->idEquipe1;
    }

    public function setIdEquipe1(?int $idEquipe1): self
    {
        $this->idEquipe1 = $idEquipe1;

        return $this;
    }

    public function getIdEquipe2(): ?int
    {
        return $this->idEquipe2;
    }

    public function setIdEquipe2(?int $idEquipe2): self
    {
        $this->idEquipe2 = $idEquipe2;

        return $this;
    }

    public function getIdEquipeRamasseurs(): ?int
    {
        return $this->idEquipeRamasseurs;
    }

    public function setIdEquipeRamasseurs(?int $idEquipeRamasseurs): self
    {
        $this->idEquipeRamasseurs = $idEquipeRamasseurs;

        return $this;
    }

    /**
     * @return Collection|Arbitre[]
     */
    public function getArbitres(): Collection
    {
        return $this->arbitres;
    }

    public function addArbitre(Arbitre $arbitre): self
    {
        if (!$this->arbitres->contains($arbitre)) {
            $this->arbitres[] = $arbitre;
        }

        return $this;
    }

    public function removeArbitre(Arbitre $arbitre): self
    {
        $this->arbitres->removeElement($arbitre);

        return $this;
    }

    public function getArbitreChaise(): ?Arbitre
    {
        return $this->arbitreChaise;
    }

    public function setArbitreChaise(?Arbitre $arbitreChaise): self
    {
        $this->arbitreChaise = $arbitreChaise;

        return $this;
    }

    public function getReservations(): ?int
    {
        return $this->reservations;
    }

    public function setReservation(?int $reservations): self
    {
        $this->reservations = $reservations;

        return $this;
    }

    public function getIdEquipeRamasseurs2(): ?int
    {
        return $this->idEquipeRamasseurs2;
    }

    public function setIdEquipeRamasseurs2(int $idEquipeRamasseurs2): self
    {
        $this->idEquipeRamasseurs2 = $idEquipeRamasseurs2;

        return $this;
    }

    /**
     * @return Collection|ReservPlace[]
     */
    public function getPlacesReservees(): Collection
    {
        return $this->placesReservees;
    }

    public function addPlacesReservee(ReservPlace $placesReservee): self
    {
        if (!$this->placesReservees->contains($placesReservee)) {
            $this->placesReservees[] = $placesReservee;
            $placesReservee->setRencontre($this);
        }

        return $this;
    }

    public function removePlacesReservee(ReservPlace $placesReservee): self
    {
        if ($this->placesReservees->removeElement($placesReservee)) {
            // set the owning side to null (unless already changed)
            if ($placesReservee->getRencontre() === $this) {
                $placesReservee->setRencontre(null);
            }
        }

        return $this;
    }

    
}
