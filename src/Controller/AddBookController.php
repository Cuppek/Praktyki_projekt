<?php

namespace App\Controller;

use App\Form\AddBookType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_ADMIN')]
class AddBookController extends AbstractController
{
    #[Route('/add', name: 'add')]
    public function index(): Response
    {
        $addBookForm = $this->createForm(AddBookType::class);

        return $this->render('book/add.html.twig', [
            'form' => $addBookForm->createView(),
        ]);
    }
}
