<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use App\Entity\Categorie;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContactsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // setup des variables
        $faker = Factory::create("fr_FR");
        $tabcat = [];
        $genres = ["male","female"];

        // catégorie
        $categorie = new Categorie();
        // business
        $categorie  -> setlibelle("professionnel")
                    -> setDescription("lorem")
                    -> setImage("img/categories/professionnel.jpg");
        $manager -> persist($categorie);
        $tabCat[] = $categorie;
        // sport
        $categorie = new Categorie();
        $categorie  -> setlibelle("sport")
                    -> setDescription("lorem")
                    -> setImage("img/categories/sport.jpg");
        $manager -> persist($categorie);
        $tabCat[] = $categorie;
        // privé
        $categorie = new Categorie();
        $categorie  -> setlibelle("privé")
                    -> setDescription("lorem")
                    -> setImage("img/categories/prive.jpg");
        $manager -> persist($categorie);
        $tabCat[] = $categorie;

        for ($i = 0; $i < 100; $i++) {
            // random
            $sexe = mt_rand(0,1);
            if ($sexe == 0) {$type = "men";}
            else {$type = "women";}
            // setup du contact
            $contact = new Contact();
            $contact->setNom($faker->lastName())
                    ->setPrenom($faker->firstName( $genres[$sexe] ))
                    ->setRue($faker->streetAddress())
                    ->setCp(strval($faker->numberbetween(75000, 92000)))
                    ->setVille($faker->city())
                    ->setMail($faker->email())
                    ->setSexe($sexe)
                    ->setAvatar("https://randomuser.me/api/portraits/{$type}/{$i}.jpg")
                    ->setCategorie($tabCat[mt_rand(0,2)]);
            $manager->persist($contact);
        }

        $manager->flush();
    }
}
