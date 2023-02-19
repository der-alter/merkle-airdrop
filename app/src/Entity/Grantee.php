<?php

namespace App\Entity;

use App\Repository\GranteeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GranteeRepository::class)]
class Grantee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 36)]
    private ?string $address = null;

    #[ORM\Column]
    private ?int $amount = null;

    #[ORM\ManyToOne(inversedBy: 'grantees')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Airdrop $airdrop = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getAirdrop(): ?Airdrop
    {
        return $this->airdrop;
    }

    public function setAirdrop(?Airdrop $airdrop): self
    {
        $this->airdrop = $airdrop;

        return $this;
    }
}
