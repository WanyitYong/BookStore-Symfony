<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TransactionRepository")
 */
class Transaction
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Book", inversedBy="transactions")
     * * @ORM\JoinColumn(nullable=false)
     */
    private $Book;

    /**
     * @ORM\Column(type="float", length=255)
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $buyer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBook(): ?Book
    {
        return $this->Book;
    }

    public function setBook(?Book $Book):self
    {
        $this->Book = $Book;
        return $this;
    }

    public function getBuyer(): ?string
    {
        return $this->buyer;
    }

    public function setBuyer(string $buyer): self
    {
        $this->buyer = $buyer;
        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function __toString()
    { return (string)$this->buyer; }
}
