<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use App\Repository\SousCategoryRepository;

class PrestationsController extends AbstractController
{
    #[Route('/prestations/', name: 'app_prestations')]
    public function getPrestation(CategoryRepository $categoryRepository, SousCategoryRepository $sousCategoryRepository) : Response
    {
        $categories = $categoryRepository->findAll();

        $sousCategory = $sousCategoryRepository->getsoucat();
        
        return $this->render('prestations/prestations.html.twig', ['categories' => $categories, 'sousCategories' => $sousCategory]);
    }
}

