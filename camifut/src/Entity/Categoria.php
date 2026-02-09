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
    private Collection $camisetas;

    public function __construct()
    {
        $this->camisetas = new ArrayCollection();
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
    public function getCamisetas(): Collection
    {
        return $this->camisetas;
    }

    public function addCamiseta(Camiseta $camiseta): static
    {
        if (!$this->camisetas->contains($camiseta)) {
            $this->camisetas->add($camiseta);
            $camiseta->setCategoria($this);
        }

        return $this;
    }

    public function removeCamiseta(Camiseta $camiseta): static
    {
        if ($this->camisetas->removeElement($camiseta)) {
            // set the owning side to null (unless already changed)
            if ($camiseta->getCategoria() === $this) {
                $camiseta->setCategoria(null);
            }
        }

        return $this;
    }
}
