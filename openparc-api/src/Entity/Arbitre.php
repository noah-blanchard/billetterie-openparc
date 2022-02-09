<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ArbitreRepository;
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
 * @ORM\Entity(repositoryClass=ArbitreRepository::class)
 */
class Arbitre
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
     * @ORM\Column(type="boolean")
     * @Groups({"read"})
     */
    private $jugeArbitre;

    /**
     * @ORM\ManyToMany(targetEntity=Rencontre::class, mappedBy="arbitres")
     * @Groups({"read"})
     */
    private $rencontresArbitrees;

    public function __construct()
    {
        $this->rencontresArbitrees = new ArrayCollection();
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

    public function getJugeArbitre(): ?bool
    {
        return $this->jugeArbitre;
    }

    public function setJugeArbitre(bool $jugeArbitre): self
    {
        $this->jugeArbitre = $jugeArbitre;

        return $this;
    }

    /**
     * @return Collection|Rencontre[]
     */
    public function getRencontresArbitrees(): Collection
    {
        return $this->rencontresArbitrees;
    }

    public function addRencontresArbitree(Rencontre $rencontresArbitree): self
    {
        if (!$this->rencontresArbitrees->contains($rencontresArbitree)) {
            $this->rencontresArbitrees[] = $rencontresArbitree;
            $rencontresArbitree->addArbitre($this);
        }

        return $this;
    }

    public function removeRencontresArbitree(Rencontre $rencontresArbitree): self
    {
        if ($this->rencontresArbitrees->removeElement($rencontresArbitree)) {
            $rencontresArbitree->removeArbitre($this);
        }

        return $this;
    }
}
