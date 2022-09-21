<?php

namespace App\Controller;

use App\Entity\Book;
use App\Entity\Theme;
use App\Form\BookType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/book', name: 'app_book')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $book = new Book();
        for ($i = 0; $i <= 2; $i++){
            $theme = new Theme();
            $book->addTheme($theme);
        }

        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($book);
            $entityManager->flush();
        }

        return $this->render('book/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
