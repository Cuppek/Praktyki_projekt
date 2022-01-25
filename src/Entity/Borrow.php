<?php

namespace App\Entity;

use App\Repository\BorrowRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BorrowRepository::class)]
class Borrow
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(inversedBy: 'borrowStatus', targetEntity: book::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $book;

    #[ORM\ManyToOne(targetEntity: user::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\Column(type: 'datetime')]
    private $borrowDateTime;

    #[ORM\Column(type: 'date')]
    private $returnDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBook(): ?book
    {
        return $this->book;
    }

    public function setBook(book $book): self
    {
        $this->book = $book;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getBorrowDateTime(): ?\DateTimeInterface
    {
        return $this->borrowDateTime;
    }

    public function setBorrowDateTime(\DateTimeInterface $borrowDateTime): self
    {
        $this->borrowDateTime = $borrowDateTime;

        return $this;
    }

    public function getReturnDate(): ?\DateTimeInterface
    {
        return $this->returnDate;
    }

    public function setReturnDate(\DateTimeInterface $returnDate): self
    {
        $this->returnDate = $returnDate;

        return $this;
    }
}
