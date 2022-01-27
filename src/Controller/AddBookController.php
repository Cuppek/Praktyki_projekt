<?php

namespace App\Controller;

use App\Form\AddBookType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddBookController extends AbstractController
{
    #[Route('/add_book', name: 'add_book')]
    public function index(): Response
    {
        $addBookForm = $this->createForm(AddBookType::class);

        return $this->render('add_book/index.html.twig', [
            'form' => $addBookForm->createView(),
        ]);
    }
}
