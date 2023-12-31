<?php
/*
 * Author: Stefan Sander <mail@stefan-sander.online>
 */

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartRepository::class)]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $sessionId = null;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setSessionId(string $sessionId): static
    {
        $this->sessionId = $sessionId;

        return $this;
    }
    public function getSessionId(): ?string
    {
        return $this->sessionId;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

}