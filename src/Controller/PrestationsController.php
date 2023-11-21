<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;

class PrestationsController extends AbstractController
{
    #[Route('/prestations', name: 'app_prestations')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('prestations/prestations.html.twig', [
            'categories' => $categories,
        ]);
    }
}

