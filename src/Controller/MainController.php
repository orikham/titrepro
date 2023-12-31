<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\PicturesRepository;
use App\Repository\InfosContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MainController extends AbstractController
{
    
    private $picturesRepository;
    private $infosContactRepository;
    private $CategoryRepository;

    public function __construct(
       
        CategoryRepository $CategoryRepository,
        PicturesRepository $picturesRepository,
        InfosContactRepository $infosContactRepository
    ) {
        $this->CategoryRepository = $CategoryRepository;
        $this->picturesRepository = $picturesRepository;
        $this->infosContactRepository = $infosContactRepository;
    }

    #[Route('/', name: 'app_home_page')]
    public function index(): Response
    {
        $category = $this->CategoryRepository->findAll();
        $cover = $this->picturesRepository->findBy(['type' => 'cover'], ['id' => 'DESC'], 5, null);
        $logo = $this->picturesRepository->findBy(['type' => 'logo']);
        $picturesPrez = $this->picturesRepository->findBy(['type' => 'prez']);
        
        

        $infosContact = $this->infosContactRepository->findAll();

        return $this->render('main/index.html.twig', [
            
            'pictures' => [
                'prez' => $picturesPrez,
                'logo' => $logo, 
                'cover' => $cover, ],  
            'infosContact' => $infosContact,
            'Category' => $category,
        ]);

       
    }

    
}
