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

        for ($i = 1; $i <= 2; $i++) {
            $baseUrl = "https://source.unsplash.com/user/c_v_r";
            $rayon = new Rayon();
            $rayon->setName('Rayon_' . $i);
            $rayon->setImage("$baseUrl/$imageWidth.'x'.$imageHeight");

            for ($j = 1; $j <= 2; $j++) {
                $category = new Categories();
                $category->setName('Category_' . $j);
                $category->setImage("$baseUrl/$imageWidth.'x'.$imageHeight");

                for ($k = 1; $k <= 3; $k++) {
                    $product = new Product();
                    $product->setName('Product_' . $k);
                    $product->setPrice(mt_rand(40, 100));
                    $product->setFeaturedImage("$baseUrl/$imageWidth".'x'."$imageHeight");
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
