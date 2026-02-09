<?php

namespace App\Entity;

use App\Repository\CategoriaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriaRepository::class)]
class Categoria
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    /**
     * @var Collection<int, Camiseta>
     */
    #[ORM\OneToMany(targetEntity: Camiseta::class, mappedBy: 'categoria')]
    private Collection $Equipos;

    public function __construct()
    {
        $this->Equipos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return Collection<int, Camiseta>
     */
    public function getEquipos(): Collection
    {
        return $this->Equipos;
    }

    public function addEquipo(Camiseta $equipo): static
    {
        if (!$this->Equipos->contains($equipo)) {
            $this->Equipos->add($equipo);
            $equipo->setCategoria($this);
        }

        return $this;
    }

    public function removeEquipo(Camiseta $equipo): static
    {
        if ($this->Equipos->removeElement($equipo)) {
            // set the owning side to null (unless already changed)
            if ($equipo->getCategoria() === $this) {
                $equipo->setCategoria(null);
            }
        }

        return $this;
    }
}
