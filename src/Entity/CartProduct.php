<?php
/*
 * Author: Stefan Sander <mail@stefan-sander.online>
 */

namespace App\Entity;

use App\Repository\CartProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Custom intermediate table to enable multiple unique entity collections without superlass
 */
#[ORM\Entity(repositoryClass: CartProductRepository::class)]
class CartProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Cart::class)]
    private ?Cart $cart = null;

    #[ORM\ManyToOne(targetEntity: Product::class)]
    private ?Product $product = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setCart(Cart $cart): static
    {
        $this->cart = $cart;

        return $this;
    }
    public function getCart(): Cart
    {
        return $this->cart;
    }

    public function setProduct(Product $product): static
    {
        $this->product = $product;

        return $this;
    }
    public function getProduct(): Product
    {
        return $this->product;
    }

}