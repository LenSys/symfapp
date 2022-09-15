<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/todos', name: 'app_todos.')]
class TodosController extends AbstractController
{
    #[Route('', name: 'index')]
    public function index(): Response
    {
        return $this->render('todos/index.html.twig', [
            'controller_name' => 'TodosController',
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
