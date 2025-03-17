<?php

namespace App\Entity;

use App\Enum\SizeEnum;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Stock
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: "stocks")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product = null;

    #[ORM\Column(enumType: SizeEnum::class)]
    private ?SizeEnum $size = null;

    #[ORM\Column(type: "integer")]
    private int $quantity = 2; // Par défaut, 2 exemplaires

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;
        return $this;
    }

    public function getSize(): ?SizeEnum
    {
        return $this->size;
    }

    public function setSize(SizeEnum $size): static
    {
        $this->size = $size;
        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;
        return $this;
    }
}
