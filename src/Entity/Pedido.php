<?php

namespace App\Entity;

use App\Repository\PedidoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PedidoRepository::class)]
class Pedido
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'pedidos')]
    private ?Cliente $Usuario = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha_pedido = null;

    /**
     * @var Collection<int, ListaProductos>
     */
    #[ORM\OneToMany(targetEntity: ListaProductos::class, mappedBy: 'Pedido', cascade: ['persist', 'remove'])]
    private Collection $lista;

    public function __construct()
    {
        $this->lista = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuario(): ?Cliente
    {
        return $this->Usuario;
    }

    public function setUsuario(?Cliente $Usuario): static
    {
        $this->Usuario = $Usuario;

        return $this;
    }

    public function getFechaPedido(): ?\DateTimeInterface
    {
        return $this->fecha_pedido;
    }

    public function setFechaPedido(\DateTimeInterface $fecha_pedido): static
    {
        $this->fecha_pedido = $fecha_pedido;

        return $this;
    }

    /**
     * @return Collection<int, ListaProductos>
     */
    public function getLista(): Collection
    {
        return $this->lista;
    }

    public function addListaProducto(ListaProductos $listaProducto): static
    {
        if (!$this->lista->contains($listaProducto)) {
            $this->lista->add($listaProducto);
            $listaProducto->setPedido($this);
        }

        return $this;
    }

    public function removeListaProducto(ListaProductos $listaProducto): static
    {
        if ($this->lista->removeElement($listaProducto)) {
            // set the owning side to null (unless already changed)
            if ($listaProducto->getPedido() === $this) {
                $listaProducto->setPedido(null);
            }
        }

        return $this;
    }
}
