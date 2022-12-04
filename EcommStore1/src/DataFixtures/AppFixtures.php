<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use App\Entity\Product;
use App\Entity\Rayon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $imageHeight = 230;
        $imageWidth  = 300;

        for ($i = 1; $i <= 7; $i++) {
            $baseUrl = "https://picsum.photos/";
            $rayon = new Rayon();
            $rayon->setName('Rayon_' . $i);
            $rayon->setImage("$baseUrl/$imageWidth/$imageHeight");

            for ($j = 1; $j <= 5; $j++) {
                $category = new Categories();
                $category->setName('Category_' . $j);
                $category->setImage("$baseUrl/$imageWidth/$imageHeight");

                for ($k = 1; $k <= 10; $k++) {
                    $product = new Product();
                    $product->setName('Product_' . $k);
                    $product->setPrice(mt_rand(40, 100));
                    $product->setFeaturedImage("$baseUrl/$imageWidth/$imageHeight");
                    $product->setIsFeatured($faker->boolean(30));
                    $product->setIsBestSeller($faker->boolean(2));
                    $product->setIsNewArrival($faker->boolean(20));
                    $product->setIsSpecialOffer($faker->boolean(30));
                    $product->setDescription($faker->text());
                    $category->addProduct($product);
                    $manager->persist($product);

                }
                $rayon->addCategory($category);
                $manager->persist($category);
            }
            $manager->persist($rayon);
        }

        $manager->flush();

    }
}
