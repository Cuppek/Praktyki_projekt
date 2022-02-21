<?php
namespace App\Controller;

use App\Entity\Book;
use App\Form\AddBookType;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_ADMIN')]
class AdminController extends AbstractController
{
    #[Route('/addBook', name: 'addBook')]
    public function addBook(Request $request, ManagerRegistry $doctrine): Response
    {
        $addBookForm = $this->createForm(AddBookType::class);

        $addBookForm->handleRequest($request);
        if ($addBookForm->isSubmitted() && $addBookForm->isValid()) {
            $em = $doctrine->getManager();

            $entityBook = new Book();
            $entityBook->setTitle($addBookForm->get('title')->getData());
            $entityBook->setAuthor($addBookForm->get('author')->getData());
            $entityBook->setDescription($addBookForm->get('description')->getData());
            $entityBook->setStatus($addBookForm->get('status')->getData());

            $em->persist($entityBook);
            $em->flush();
        }

        return $this->render('book/addBook.html.twig', [
            'form' => $addBookForm->createView(),
        ]);
    }
}