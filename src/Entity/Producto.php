<?php

namespace App\Entity;

use App\Repository\ProductoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductoRepository::class)]
class Producto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nombre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Descripcion = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $Precio = null;

    /**
     * @var Collection<int, ListaProductos>
     */
    #[ORM\ManyToMany(targetEntity: ListaProductos::class, mappedBy: 'Articulo')]
    private Collection $listaProductos;

    public function __construct()
    {
        $this->listaProductos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): static
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->Descripcion;
    }

    public function setDescripcion(string $Descripcion): static
    {
        $this->Descripcion = $Descripcion;

        return $this;
    }

    public function getPrecio(): ?string
    {
        return $this->Precio;
    }

    public function setPrecio(string $Precio): static
    {
        $this->Precio = $Precio;

        return $this;
    }

    /**
     * @return Collection<int, ListaProductos>
     */
    public function getListaProductos(): Collection
    {
        return $this->listaProductos;
    }

    public function addListaProducto(ListaProductos $listaProducto): static
    {
        if (!$this->listaProductos->contains($listaProducto)) {
            $this->listaProductos->add($listaProducto);
            $listaProducto->addArticulo($this);
        }

        return $this;
    }

    public function removeListaProducto(ListaProductos $listaProducto): static
    {
        if ($this->listaProductos->removeElement($listaProducto)) {
            $listaProducto->removeArticulo($this);
        }

        return $this;
    }
}
