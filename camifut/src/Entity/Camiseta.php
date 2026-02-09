<?php

namespace App\Entity;

use App\Repository\CamisetaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CamisetaRepository::class)]
class Camiseta
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Equipo = null;

    #[ORM\Column]
    private ?int $Preu = null;

    #[ORM\ManyToOne(inversedBy: 'Equipos')]
    private ?Categoria $categoria = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEquipo(): ?string
    {
        return $this->Equipo;
    }

    public function setEquipo(string $Equipo): static
    {
        $this->Equipo = $Equipo;

        return $this;
    }

    public function getPreu(): ?int
    {
        return $this->Preu;
    }

    public function setPreu(int $Preu): static
    {
        $this->Preu = $Preu;

        return $this;
    }

    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): static
    {
        $this->categoria = $categoria;

        return $this;
    }
}
