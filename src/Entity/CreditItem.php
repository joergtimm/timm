<?php

namespace App\Entity;

use App\Repository\CreditItemRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CreditItemRepository::class)]
class CreditItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?float $quantity = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $unit = null;

    #[ORM\Column(nullable: true)]
    private ?int $unitNetPrice = null;

    #[ORM\Column(nullable: true)]
    private ?int $taxRate = null;

    #[ORM\Column(nullable: true)]
    private ?int $taxAmount = null;

    #[ORM\Column(nullable: true)]
    private ?int $unitGrossPrice = null;

    #[ORM\Column(nullable: true)]
    private ?int $totalNet = null;

    #[ORM\Column(nullable: true)]
    private ?int $totalTax = null;

    #[ORM\Column(nullable: true)]
    private ?int $totalGross = null;

    #[ORM\Column(nullable: true)]
    private ?int $position = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'creditItems')]
    private ?Credit $credit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    public function setQuantity(?float $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(?string $unit): static
    {
        $this->unit = $unit;

        return $this;
    }

    public function getUnitNetPrice(): ?int
    {
        return $this->unitNetPrice;
    }

    public function setUnitNetPrice(?int $unitNetPrice): static
    {
        $this->unitNetPrice = $unitNetPrice;

        return $this;
    }

    public function getTaxRate(): ?int
    {
        return $this->taxRate;
    }

    public function setTaxRate(?int $taxRate): static
    {
        $this->taxRate = $taxRate;

        return $this;
    }

    public function getTaxAmount(): ?int
    {
        return $this->taxAmount;
    }

    public function setTaxAmount(?int $taxAmount): static
    {
        $this->taxAmount = $taxAmount;

        return $this;
    }

    public function getUnitGrossPrice(): ?int
    {
        return $this->unitGrossPrice;
    }

    public function setUnitGrossPrice(?int $unitGrossPrice): static
    {
        $this->unitGrossPrice = $unitGrossPrice;

        return $this;
    }

    public function getTotalNet(): ?int
    {
        return $this->totalNet;
    }

    public function setTotalNet(?int $totalNet): static
    {
        $this->totalNet = $totalNet;

        return $this;
    }

    public function getTotalTax(): ?int
    {
        return $this->totalTax;
    }

    public function setTotalTax(?int $totalTax): static
    {
        $this->totalTax = $totalTax;

        return $this;
    }

    public function getTotalGross(): ?int
    {
        return $this->totalGross;
    }

    public function setTotalGross(?int $totalGross): static
    {
        $this->totalGross = $totalGross;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(?int $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getCredit(): ?Credit
    {
        return $this->credit;
    }

    public function setCredit(?Credit $credit): static
    {
        $this->credit = $credit;

        return $this;
    }
}
