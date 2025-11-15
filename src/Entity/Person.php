<?php

namespace App\Entity;

use App\Repository\PersonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonRepository::class)]
class Person
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $familyName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $givenName = null;

    #[ORM\Column(length: 255)]
    private ?string $adressStreet = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $adressZipCode = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $adressLocation = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $adressCountry = null;

    /**
     * @var Collection<int, Credit>
     */
    #[ORM\OneToMany(targetEntity: Credit::class, mappedBy: 'person')]
    private Collection $credits;

    public function __construct()
    {
        $this->credits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getFamilyName(): ?string
    {
        return $this->familyName;
    }

    public function setFamilyName(string $familyName): static
    {
        $this->familyName = $familyName;

        return $this;
    }

    public function getGivenName(): ?string
    {
        return $this->givenName;
    }

    public function setGivenName(?string $givenName): static
    {
        $this->givenName = $givenName;

        return $this;
    }

    public function getAdressStreet(): ?string
    {
        return $this->adressStreet;
    }

    public function setAdressStreet(string $adressStreet): static
    {
        $this->adressStreet = $adressStreet;

        return $this;
    }

    public function getAdressZipCode(): ?string
    {
        return $this->adressZipCode;
    }

    public function setAdressZipCode(?string $adressZipCode): static
    {
        $this->adressZipCode = $adressZipCode;

        return $this;
    }

    public function getAdressLocation(): ?string
    {
        return $this->adressLocation;
    }

    public function setAdressLocation(?string $adressLocation): static
    {
        $this->adressLocation = $adressLocation;

        return $this;
    }

    public function getAdressCountry(): ?string
    {
        return $this->adressCountry;
    }

    public function setAdressCountry(?string $adressCountry): static
    {
        $this->adressCountry = $adressCountry;

        return $this;
    }

    /**
     * @return Collection<int, Credit>
     */
    public function getCredits(): Collection
    {
        return $this->credits;
    }

    public function addCredit(Credit $credit): static
    {
        if (!$this->credits->contains($credit)) {
            $this->credits->add($credit);
            $credit->setPerson($this);
        }

        return $this;
    }

    public function removeCredit(Credit $credit): static
    {
        if ($this->credits->removeElement($credit)) {
            // set the owning side to null (unless already changed)
            if ($credit->getPerson() === $this) {
                $credit->setPerson(null);
            }
        }

        return $this;
    }

}
