<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PlaceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *      forceEager=false,
 *      normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}}
 * )
 * @ORM\Entity(repositoryClass=PlaceRepository::class)
 */
class Place
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read", "write"})
     */
    private $tribune;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"read", "write"})
     */
    private $cat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTribune(): ?string
    {
        return $this->tribune;
    }

    public function setTribune(?string $tribune): self
    {
        $this->tribune = $tribune;

        return $this;
    }

    public function getCat(): ?int
    {
        return $this->cat;
    }

    public function setCat(?int $cat): self
    {
        $this->cat = $cat;

        return $this;
    }
}
