<?php

namespace App\Entity;

use App\Repository\AirdropRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AirdropRepository::class)]
class Airdrop
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column(length: 36)]
    private ?string $owner = null;

    #[ORM\ManyToOne(inversedBy: 'airdrops')]
    private ?Token $token = null;

    #[ORM\OneToMany(mappedBy: 'airdrop', targetEntity: Grantee::class, orphanRemoval: true)]
    private Collection $grantees;

    public function __construct()
    {
        $this->grantees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getOwner(): ?string
    {
        return $this->owner;
    }

    public function setOwner(string $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getToken(): ?Token
    {
        return $this->token;
    }

    public function setToken(?Token $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return Collection<int, Grantee>
     */
    public function getGrantees(): Collection
    {
        return $this->grantees;
    }

    public function addGrantee(Grantee $grantee): self
    {
        if (!$this->grantees->contains($grantee)) {
            $this->grantees->add($grantee);
            $grantee->setAirdrop($this);
        }

        return $this;
    }

    public function removeGrantee(Grantee $grantee): self
    {
        if ($this->grantees->removeElement($grantee)) {
            // set the owning side to null (unless already changed)
            if ($grantee->getAirdrop() === $this) {
                $grantee->setAirdrop(null);
            }
        }

        return $this;
    }
}
