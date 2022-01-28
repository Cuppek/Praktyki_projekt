<?php

namespace App\Controller;

use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AllBooksController extends AbstractController
{
    #[Route('/all_books', name: 'all_books')]
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $allAvailableBooks = $em->getRepository(Book::class)->findByStatus(1);
        $allBooks = $em->getRepository(Book::class)->findAll();

        return $this->render('all_books/index.html.twig', [
            'allAvailableBooks' => $allAvailableBooks,
            'allBooks' => $allBooks,
        ]);
    }
}
