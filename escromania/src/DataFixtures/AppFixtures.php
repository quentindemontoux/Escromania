<?php

namespace App\DataFixtures;

use App\Entity\Game;
use App\Entity\Tags;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $tag1 = new Tags();
        $tag1->setName("First Person Shooter");

        $manager->persist($tag1);

        $tag2 = new Tags();
        $tag2->setName("Horror");

        $manager->persist($tag2);
        
        $tag3 = new Tags();
        $tag3->setName("Warfare");

        $manager->persist($tag3);

        $tag4 = new Tags();
        $tag4->setName("Strategy");

        $manager->persist($tag4);

        $tag5 = new Tags();
        $tag5->setName("Medieval");

        $manager->persist($tag5);

        $tag6 = new Tags();
        $tag6->setName("Multiplayer");

        $manager->persist($tag6);

        $tag7 = new Tags();
        $tag7->setName("Cooperation");

        $manager->persist($tag7);

        $dateSrc = '2019-08-23';
        $date1 = new DateTime($dateSrc);

        $game1 = new Game();
        $game1->setName("Call of Duty : Modern Warfare")
        ->setPrice(60)
        ->setPublisher("Actipognon")
        ->setDeveloper("Infinity Ward")
        ->setDescription("Des combats terrestres intenses. Les environnements les plus photoréalistes de la franchise. 
        Les modes Multijoueur préférés et des séries d'éliminations épiques.
        Une personnalisation des armes extrêmement poussée. Le meilleur gameplay de sa catégorie. Et bien plus.")
        ->setReleasedAt($date1)
        ->addTag($tag1)
        ->addTag($tag3)
        ->addTag($tag6);
        
        $manager->persist($game1);

        $manager->flush();
    }
}
