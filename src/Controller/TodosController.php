<?php

namespace App\Controller;

use App\Repository\TodoItemRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/todos', name: 'app_todos.')]
class TodosController extends AbstractController
{
    #[Route('', name: 'index')]
    public function index(TodoItemRepository $todoItemRepository): Response
    {
        $todoItems = $todoItemRepository->findAll();
        
        return $this->render('todos/index.html.twig', [
            'todoItems' => $todoItems
        ]);
    }


    #[Route('/create', name: 'create')]
    public function create():Response 
    {
        return $this->render('todos/create.html.twig', [
            'controller_name' => 'TodosController',
        ]);
    }
}
