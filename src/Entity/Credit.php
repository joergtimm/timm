<?php

namespace App\Entity;

use App\Repository\CreditRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CreditRepository::class)]
class Credit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(length: 30)]
    private ?string $documentId = null;

    #[ORM\ManyToOne(inversedBy: 'credits')]
    private ?Person $person = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $billingPeriode = null;

    /**
     * @var Collection<int, CreditItem>
     */
    #[ORM\OneToMany(targetEntity: CreditItem::class, mappedBy: 'credit', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $creditItems;

    public function __construct()
    {
        $this->creditItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getDocumentId(): ?string
    {
        return $this->documentId;
    }

    public function setDocumentId(string $documentId): static
    {
        $this->documentId = $documentId;

        return $this;
    }

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(?Person $person): static
    {
        $this->person = $person;

        return $this;
    }

    public function getBillingPeriode(): ?\DateTime
    {
        return $this->billingPeriode;
    }

    public function setBillingPeriode(?\DateTime $billingPeriode): static
    {
        $this->billingPeriode = $billingPeriode;

        return $this;
    }

    /**
     * @return Collection<int, CreditItem>
     */
    public function getCreditItems(): Collection
    {
        return $this->creditItems;
    }

    public function addCreditItem(CreditItem $creditItem): static
    {
        if (!$this->creditItems->contains($creditItem)) {
            $this->creditItems->add($creditItem);
            $creditItem->setCredit($this);
        }

        return $this;
    }

    public function removeCreditItem(CreditItem $creditItem): static
    {
        if ($this->creditItems->removeElement($creditItem)) {
            // set the owning side to null (unless already changed)
            if ($creditItem->getCredit() === $this) {
                $creditItem->setCredit(null);
            }
        }

        return $this;
    }
}
