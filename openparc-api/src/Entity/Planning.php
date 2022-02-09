<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PlanningRepository;
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
 * @ORM\Entity(repositoryClass=PlanningRepository::class)
 */
class Planning
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    private $nombreMatchs;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    private $nombreJoueurs;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    private $nombreQualifies;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read"})
     */
    private $nomPlanning;

    /**
     * @ORM\OneToMany(targetEntity=Rencontre::class, mappedBy="idPlanning")
     * @Groups({"read"})
     */
    private $matchs;

    public function __construct()
    {
        $this->matchs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreMatchs(): ?int
    {
        return $this->nombreMatchs;
    }

    public function setNombreMatchs(int $nombreMatchs): self
    {
        $this->nombreMatchs = $nombreMatchs;

        return $this;
    }

    public function getNombreJoueurs(): ?int
    {
        return $this->nombreJoueurs;
    }

    public function setNombreJoueurs(int $nombreJoueurs): self
    {
        $this->nombreJoueurs = $nombreJoueurs;

        return $this;
    }

    public function getNombreQualifies(): ?int
    {
        return $this->nombreQualifies;
    }

    public function setNombreQualifies(int $nombreQualifies): self
    {
        $this->nombreQualifies = $nombreQualifies;

        return $this;
    }

    public function getNomPlanning(): ?string
    {
        return $this->nomPlanning;
    }

    public function setNomPlanning(string $nomPlanning): self
    {
        $this->nomPlanning = $nomPlanning;

        return $this;
    }

    /**
     * @return Collection|Rencontre[]
     */
    public function getMatchs(): Collection
    {
        return $this->matchs;
    }

    public function addMatch(Rencontre $match): self
    {
        if (!$this->matchs->contains($match)) {
            $this->matchs[] = $match;
            $match->setIdPlanning($this);
        }

        return $this;
    }

    public function removeMatch(Rencontre $match): self
    {
        if ($this->matchs->removeElement($match)) {
            // set the owning side to null (unless already changed)
            if ($match->getIdPlanning() === $this) {
                $match->setIdPlanning(null);
            }
        }

        return $this;
    }
}
