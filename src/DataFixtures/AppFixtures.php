<?php
// src/DataFixtures/AppFixtures.php
namespace App\DataFixtures;

use Faker\Factory;
use Faker\Generator;
use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    /**
     * @var Generator
     */
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {
        $ingredients = [
            ['name' => 'Farine', 'price' => 0.8],
            ['name' => 'Sucre', 'price' => 0.5],
            ['name' => 'Levure chimique', 'price' => 1.2],
            ['name' => 'Oeufs', 'price' => 2.0],
            ['name' => 'Beurre', 'price' => 1.5],
            ['name' => 'Lait', 'price' => 1.0],
            ['name' => 'Huile d\'olive', 'price' => 2.5],
            ['name' => 'Vinaigre balsamique', 'price' => 3.0],
            ['name' => 'Crème fraîche', 'price' => 1.8],
            ['name' => 'Yaourt', 'price' => 1.2],
            ['name' => 'Miel', 'price' => 2.3],
            ['name' => 'Sel', 'price' => 0.3],
            ['name' => 'Poivre', 'price' => 0.4],
            ['name' => 'Ail', 'price' => 0.6],
            ['name' => 'Persil', 'price' => 0.7],
            ['name' => 'Basilic', 'price' => 0.7],
            ['name' => 'Thym', 'price' => 0.5],
            ['name' => 'Origane', 'price' => 0.5],
            ['name' => 'Cannelle', 'price' => 0.8],
            ['name' => 'Muscade', 'price' => 0.8],
            ['name' => 'Pomme de terre', 'price' => 0.6],
            ['name' => 'Riz', 'price' => 1.0],
            ['name' => 'Pâtes', 'price' => 0.75],
            ['name' => 'Blé', 'price' => 1.2],
            ['name' => 'Maïs', 'price' => 1.1],
            ['name' => 'Quinoa', 'price' => 2.0],
            ['name' => 'Orge', 'price' => 1.5],
            ['name' => 'Semoule', 'price' => 0.8],
            ['name' => 'Patate douce', 'price' => 0.9],
            ['name' => 'Couscous', 'price' => 0.85],
            ['name' => 'Pomme', 'price' => 1.0],
            ['name' => 'Banane', 'price' => 0.75],
            ['name' => 'Orange', 'price' => 0.85],
            ['name' => 'Tomate', 'price' => 0.5],
            ['name' => 'Carotte', 'price' => 0.4],
            ['name' => 'Poire', 'price' => 1.2],
            ['name' => 'Fraise', 'price' => 1.5],
            ['name' => 'Raisin', 'price' => 1.25],
            ['name' => 'Courgette', 'price' => 0.6],
            ['name' => 'Brocoli', 'price' => 0.75],
        ];

        // Parcourez le tableau d'ingrédients et créez des objets Ingredient pour chaque entrée
        foreach ($ingredients as $ingredientData) {
            $ingredient = new Ingredient();
            $ingredient->setName($ingredientData['name'])
                ->setPrice($ingredientData['price']);

            $manager->persist($ingredient);
        }

        $manager->flush();
    }
}