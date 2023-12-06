<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;  // Assurez-vous d'importer l'entité Category
use App\Entity\SousCategory;  // Assurez-vous d'importer l'entité SousCategory

class CategoryController extends AbstractController
{
    #[Route('/category/{categoryId}', name: 'app_category')]
    public function sousCategoriesPage($categoryId): Response
    {
       
        $category = $this->getDoctrine()->getRepository(Category::class)->find($categoryId);

        // Vous pouvez maintenant accéder aux sous-catégories liées à la catégorie
        $sousCategories = $category->getSoucat();  // Utilisez la méthode getSoucat définie dans l'entité Category

        return $this->render('category/index.html.twig', [
            'sousCategories' => $sousCategories,
        ]);
    }
}
