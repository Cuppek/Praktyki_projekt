<?php
namespace App\Controller;

use App\Entity\Book;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_USER')]
class UserController extends AbstractController
{
    private \Doctrine\Persistence\ObjectRepository $bookRepository;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->bookRepository = $doctrine->getManager()->getRepository(Book::class);
    }

    #[Route('/allBooks', name: 'allBooks')]
    public function allBooks(): Response
    {
        $allBooks = $this->bookRepository->findAll();

        return $this->render('book/allBooks.html.twig', [
            'allBooks' => $allBooks,
        ]);
    }

    #[Route('/borrowed', name: 'borrowed')]
    public function borrowed(): Response
    {
        $borrowedBooks = $this->bookRepository->findBy();

        return $this->render('borrowed.html.twig', [
            'borrowed' => $borrowedBooks,
        ]);
    }
}