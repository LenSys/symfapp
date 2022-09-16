<?php

namespace App\Controller;

use App\Repository\TodoItemRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\TodoItem;
use App\Form\TodoItemFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

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
    public function create(Request $request, EntityManagerInterface $entityManager):Response 
    {
        $todoItem = new TodoItem();
        $todoItemForm = $this->createForm(TodoItemFormType::class, $todoItem);

        $todoItemForm->handleRequest($request);

        // check if form is submitted and valid
        if($todoItemForm->isSubmitted() && $todoItemForm->isValid()) {
            // save form input into database table
            $entityManager->persist($todoItem);
            $entityManager->flush();

            // redirect to index page of todos
            return $this->redirect($this->generateUrl(route:'app_todos.index'));
        }

        return $this->render('todos/create.html.twig', [
            'todo_item_form' => $todoItemForm->createView()
        ]);
    }
}
