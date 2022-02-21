<?php
namespace App\Controller;

use App\Entity\Book;
use App\Entity\Borrow;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_USER')]
class UserController extends AbstractController
{
    private \Doctrine\Persistence\ObjectRepository $bookRepository;
    private \Doctrine\Persistence\ObjectRepository $borrowRepository;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->bookRepository = $doctrine->getManager()->getRepository(Book::class);
        $this->borrowRepository = $doctrine->getManager()->getRepository(Borrow::class);
    }

    #[Route('/allBooks', name: 'allBooks')]
    public function allBooks(): Response
    {
        $allAvailableBooks = $this->bookRepository->findBy(['status' => 1]);

        return $this->render('book/allBooks.html.twig', [
            'allAvailableBooks' => $allAvailableBooks,
        ]);
    }

    #[Route('/borrowed', name: 'borrowed')]
    public function borrowed(): Response
    {
        $borrowMade = $this->borrowRepository->findBy(['user' => $this->getUser()]);

        return $this->render('book/borrowed.html.twig', [
            'borrows' => $borrowMade,
        ]);
    }
}