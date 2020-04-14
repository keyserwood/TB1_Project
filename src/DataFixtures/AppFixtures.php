<?php

namespace App\DataFixtures;

use App\Entity\Articles;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        // Creation d'un nouvel article
        $faker = \Faker\Factory::create('fr_FR');
        $article1 = new Articles();
        $article2 = new Articles();
        $article3 = new Articles();
        $article4 = new Articles();
        $articles =[$article1,$article2,$article3,$article4];

        foreach($articles as $article)
        {
            $article->setTitle($faker->numerify("Article ###"))
                    ->setContent($faker->text);
            $manager->persist($article);

        }



        $manager->flush();
    }
}
