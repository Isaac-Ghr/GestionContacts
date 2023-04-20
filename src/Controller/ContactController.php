<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contacts', name: 'app_contacts')]
    public function listContact(ContactRepository $repo): Response
    {
        $contacts = $repo->findAll();
        return $this->render('contact/listeContacts.html.twig', [
            'controller_name' => 'ContactController',
            'lesContacts' => $contacts
        ]);
    }
}
