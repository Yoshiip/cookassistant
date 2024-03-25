<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Dotenv\Dotenv;

class ChiefController extends AbstractController
{

    public function askChief(string $ingredients): string
    {
        $client = HttpClient::create();
        $apiUrl = 'https://api.openai.com/v1/chat/completions';
        $apiKey = $_ENV['OPENAI_API_KEY'];
        $data = [
            "model" => "gpt-3.5-turbo",
            "messages" => [
                [
                    "role" => "system",
                    "content" => "Vous êtes un cuisinier. L'utilisateur va vous soumettre plusieurs ingrédients, et uniquement a partir de ses ingrédients vous devrez renvoyer un plat. Soyez extrêmement concis dans votre réponse, donner simplement le nom du plat. Soyez créatif, n'hésitez pas à donner des noms de plats alambiqué si l'occassion se présente. Si certains ingrédiens ont un nom innapropriés, répondez simplement 'Je n'ai rien à vous proposer...'."
                ],
                [
                    "role" => "user",
                    "content" => "Fait moi une recette à partir et uniquement à partir de : " . $ingredients
                ]
            ]
        ];

        $response = $client->request('POST', $apiUrl, [
            'headers' => [
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => $data,
        ]);

        $responseData = $response->toArray();

        $generatedText = $responseData['choices'][0]['message']['content'];
        return $generatedText;
    }

    #[Route('/chief', name: 'chief_index', methods: ['GET'])]
    public function index(IngredientRepository $repository, Request $request): Response
    {
        $selectedIngredientIds = $request->query->all('id');

        $selectedIngredients = $repository->findBy(['id' => $selectedIngredientIds]);
        
        $ingredientNames = [];
        $totalPrice = 0;
        foreach ($selectedIngredients as $ingredient) {
            $ingredientNames[] = $ingredient->getName();
            $totalPrice += $ingredient->getPrice();
        }
        // Retrieve all ingredients from the repository
        // $ingredients = $repository->findAll();

        return $this->render('pages/chief/index.html.twig', [
            'selectedIngredients' => $selectedIngredients,
            'chiefAnswer' => $this->askChief(implode(", ", $ingredientNames)),
            'totalPrice' => $totalPrice
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
