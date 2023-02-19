<?php

namespace App\Entity;

use App\Repository\TokenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TokenRepository::class)]
class Token
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $fa2Id = null;

    #[ORM\Column(length: 36)]
    private ?string $address = null;

    #[ORM\Column]
    private array $metadata = [];

    #[ORM\OneToMany(mappedBy: 'token', targetEntity: Airdrop::class)]
    private Collection $airdrops;

    public function __construct()
    {
        $this->airdrops = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFa2Id(): ?int
    {
        return $this->fa2Id;
    }

    public function setFa2Id(int $fa2Id): self
    {
        $this->fa2Id = $fa2Id;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getMetadata(): array
    {
        return $this->metadata;
    }

    public function setMetadata(array $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    /**
     * @return Collection<int, Airdrop>
     */
    public function getAirdrops(): Collection
    {
        return $this->airdrops;
    }

    public function addAirdrop(Airdrop $airdrop): self
    {
        if (!$this->airdrops->contains($airdrop)) {
            $this->airdrops->add($airdrop);
            $airdrop->setToken($this);
        }

        return $this;
    }

    public function removeAirdrop(Airdrop $airdrop): self
    {
        if ($this->airdrops->removeElement($airdrop)) {
            // set the owning side to null (unless already changed)
            if ($airdrop->getToken() === $this) {
                $airdrop->setToken(null);
            }
        }

        return $this;
    }
}
