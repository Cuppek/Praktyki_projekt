<?php
namespace App\Service;

use App\Entity\Book;
use App\Entity\Borrow;
use Doctrine\Persistence\ManagerRegistry;

class BookService
{
    private $borrowRepository;

    public function __construct(ManagerRegistry $doctrine)
    {

        $this->borrowRepository = $doctrine->getManager()->getRepository(Borrow::class);
    }

    public function isBookBorrowed(Book $book)
    {
        if ($this->borrowRepository->findBy(['title' => $book->getTitle()])) {
            return true;
        } else {
            return false;
        }
    }
}