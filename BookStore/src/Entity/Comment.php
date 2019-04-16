<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $userInput;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $buyer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Book")
     */
    private $book;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserInput(): ?string
    {
        return $this->userInput;
    }

    public function setUserInput(?string $userInput): self
    {
        $this->userInput = $userInput;

        return $this;
    }

    public function getBuyer(): ?string
    {
        return $this->buyer;
    }

    public function setBuyer(?string $buyer): self
    {
        $this->buyer = $buyer;

        return $this;
    }

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(?Book $book): self
    {
        $this->book = $book;

        return $this;
    }
}
