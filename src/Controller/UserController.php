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
    private \Doctrine\Persistence\ObjectManager $em;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->bookRepository = $doctrine->getManager()->getRepository(Book::class);
        $this->borrowRepository = $doctrine->getManager()->getRepository(Borrow::class);
        $this->em = $doctrine->getManager();
    }

    #[Route('/allBooks', name: 'allBooks')]
    public function allBooks(): Response
    {
        if (in_array('ROLE_ADMIN', $this->getUser()->getRoles()))
        {
            $allBooks = $this->bookRepository->findAll();
        } else {
            $allBooks = $this->bookRepository->findBy(['status' => 1]);
        }

        return $this->render('book/allBooks.html.twig', [
            'allBooks' => $allBooks,
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

    #[Route('/borrow/{$id}', name: 'borrow')]
    public function borrow(int $id)
    {
        $date = new \DateTime();
        $borrow = new Borrow();
        $borrow->setUser($this->getUser());
        $borrow->setBorrowDateTime($date);
        $borrow->setReturnDate($date->add(new \DateInterval('P14D')));
        $borrow->setBook($this->bookRepository->findOneById($id));

        $this->em->persist($borrow);
        $this->em->flush();
        return $this->redirectToRoute('allBooks');
    }
}