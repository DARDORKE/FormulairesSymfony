<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{
    /**
     * @Route("/recipe", name="recipe")
     */
    public function index(Request $request, EntityManagerInterface $entityManager)
    {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);
        $error = '';
        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('condition')->getData()) {
                $entityManager->persist($recipe);
                $entityManager->flush();
            } else {
                $error = 'Vous devez accepter les conditions';
            }

        }
        return $this->render('recipe/index.html.twig', [
            'form' => $form->createView(),
            'error' => $error,
        ]);
    }
}