<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ComposeController extends AbstractController
{
    #[Route('/compose', name: 'compose_index', methods: ['GET'])]
    public function index(IngredientRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        // Retrieve all ingredients from the repository
        $ingredients = $repository->findAll();

        return $this->render('pages/compose/list.html.twig', [
            'ingredients' => $ingredients
        ]);
    }

    // #[Route('/ingredient/new', name: 'ingredient.new', methods: ['GET', 'POST'])]
    // public function new(Request $request,
    // EntityManagerInterface $manager) : Response {
    //     $ingredient = new Ingredient();
    //     $form = $this->createForm(IngredientType::class, $ingredient);

    //     $form->handleRequest($request);
    //     if($form->isSubmitted() && $form->isValid()) {
    //         $ingredient = $form->getData();

    //         $manager->persist($ingredient);
    //         $manager->flush();

    //         $this->addFlash(
    //             'success',
    //             'Votre ingrédient a été créé avec succès!',
    //         );

    //         $this->redirectToRoute('ingredient_index');


    //     } else {

    //     }

    //     return $this->render('pages/ingredient/new.html.twig', [
    //         'form' => $form->createView()
    //     ]);
    // }
}
