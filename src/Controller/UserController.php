<?php
namespace App\Controller;

use App\Entity\Book;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_USER')]
class UserController extends AbstractController
{
    #[Route('/all', name: 'all')]
    public function all(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $allAvailableBooks = $em->getRepository(Book::class)->findByStatus(1);
        $allBooks = $em->getRepository(Book::class)->findAll();

        return $this->render('book/all.html.twig', [
            'allAvailableBooks' => $allAvailableBooks,
            'allBooks' => $allBooks,
        ]);
    }
}