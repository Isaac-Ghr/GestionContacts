<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContactsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // setup des variables
        $faker = Factory::create("fr_FR");
        $genres = ["male","female"];

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
                    ->setAvatar("https://randomuser.me/api/portraits/{$type}/{$i}.jpg");
            $manager->persist($contact);
        }

        $manager->flush();
    }
}
