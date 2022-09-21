<?php

namespace App\Controller;

use App\Form\ConverterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConverterController extends AbstractController
{
    #[Route('/converter', name: 'app_converter')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(ConverterType::class);
        $form->handleRequest($request);
        $convertValue = 0;
        if ($form->isSubmitted() && $form->isValid()){
            $grams = $form->get('grams')->getData();
            $unity = $form->get('unity')->getData();
            $convertValue = $grams / $unity;
        }

        return $this->render('converter/index.html.twig', [
            'form' => $form->createView(),
            'convert_value' => $convertValue,
        ]);
    }
}
