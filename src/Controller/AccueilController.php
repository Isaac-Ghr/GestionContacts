<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil', methods: 'GET')]
    public function index(ContactRepository $repoCon, CategorieRepository $repoCat): Response
    {
        $contacts = $repoCon->findAll();
        $categories = $repoCat->findAll();
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'lesContacts' => $contacts,
            'lesCategories' => $categories
        ]);
    }
}
