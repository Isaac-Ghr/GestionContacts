<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contacts', name: 'app_contacts', methods: 'GET')]
    public function listContact(ContactRepository $repo): Response
    {
        $contacts = $repo->findAll();
        return $this->render('contact/listeContacts.html.twig', [
            'controller_name' => 'ContactController',
            'lesContacts' => $contacts
        ]);
    }

    #[Route('/contact/{id}', name: 'app_ficheContact', methods: 'GET')]
    public function ficheContact(Contact $contact): Response
    {
        return $this->render('contact/ficheContact.html.twig', [
            'controller_name' => 'ContactController',
            'leContact' => $contact
        ]);
    }

    #[Route('/contacts/sexe/{sexe}', name: 'app_contactsSexe', methods: 'GET')]
    public function ficheContactsSexe($sexe, ContactRepository $repo): Response
    {
        // empêche d'entrer une valeur non valide
        if ($sexe < 0) {$sexe = 0;} else if ($sexe > 1) {$sexe = 1;}
        $contacts = $repo->findBySexe($sexe);
        return $this->render('contact/listeContacts.html.twig', [
            'controller_name' => 'ContactController',
            'lesContacts' => $contacts,
            'leSexe' => $sexe
        ]);
    }
}
