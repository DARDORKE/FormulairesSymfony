<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\CreateTaskType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    #[Route('/task', name: 'create')]
    public function createTaskWithoutDeadline(Request $request, EntityManagerInterface $entityManager): Response
    {
        $task = new Task();
        $hasDeadline = false;
        $form = $this->createForm(CreateTaskType::class, $task, [
            'hasDeadline' => $hasDeadline,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($task);
            $entityManager->flush();
        }

        return $this->render('task/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/task-deadline', name: 'create-deadline')]
    public function createTaskWithDeadline(Request $request, EntityManagerInterface $entityManager): Response
    {
        $task = new Task();
        $hasDeadline = true;
        $form = $this->createForm(CreateTaskType::class, $task, [
            'hasDeadline' => $hasDeadline,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($task);
            $entityManager->flush();
        }

        return $this->render('task/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
