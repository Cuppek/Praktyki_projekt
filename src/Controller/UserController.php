<?php
namespace App\Controller;

use App\Entity\Book;
use Doctrine\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_USER')]
class UserController extends AbstractController
{
    private ObjectManager $em;

    public function __construct()
    {
        $this->em = $this->getDoctrine()->getManager();
    }

    #[Route('/all', name: 'all')]
    public function all(): Response
    {
        $allAvailableBooks = $this->em->getRepository(Book::class)->findByStatus(1);
        $allBooks = $this->em->getRepository(Book::class)->findAll();

        return $this->render('book/all.html.twig', [
            'allAvailableBooks' => $allAvailableBooks,
            'allBooks' => $allBooks,
        ]);
    }

    #[Route('/borrowed', name: 'borrowed')]
    public function borrowed(): Response
    {
        $borrowedBooks = $this->em->getRepository(Book::class)->findBy();

        return $this->render('borrowed.html.twig', [
            'borrowed' => $borrowedBooks,
        ]);
    }
}