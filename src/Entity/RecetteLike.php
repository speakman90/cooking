<?php

namespace App\Entity;

use App\Repository\RecetteLikeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecetteLikeRepository::class)]
class RecetteLike
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: recettes::class, inversedBy: 'likes')]
    private $recette;

    #[ORM\ManyToOne(targetEntity: user::class, inversedBy: 'likes')]
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecette(): ?recettes
    {
        return $this->recette;
    }

    public function setRecette(?recettes $recette): self
    {
        $this->recette = $recette;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }
}
