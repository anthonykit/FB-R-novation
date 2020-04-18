<?php

namespace App\DataFixtures;

use App\Entity\Article3;
use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker= \Faker\Factory::create('fr_FR');
        for ($i = 1; $i <= 10; $i++){
            $article= new Article3();

            $content = '<p>' . join($faker->paragraphs(5),'</p><p>') .'</p>';

            $article->setTitle($faker->sentence())
                    ->setContent($content)
                    ->setImage($faker->imageUrl())
                    ->setCreatedAt(new \DateTime());
            $manager->persist($article);
        }
        for ($j = 1; $j <= mt_rand(4,10); $j++) {
            $comment = new Comment();
            $comment ='<p>'. join($faker->paragraphs(2),'</p><p>') . '</p>';
            $now = new \DateTime();
            $interval = $now->diff($article->getCreatedAt());
            $days = $interval->days;


            $comment->setAuthor($faker->name)
                    ->setContent($content)
                    ->setCreatedAt($faker->dateTimeBetween,('-' . $days . ' days'))
                    ->setArticle($article);
            $manager->persist($comment);
        }
                $manager->flush();
    }
}
