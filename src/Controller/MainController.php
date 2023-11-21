<?php

namespace App\Controller;

use App\Repository\PrestationsRepository;
use App\Repository\PicturesRepository;
use App\Repository\InfosContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    private $prestationsRepository;
    private $picturesRepository;
    private $infosContactRepository;

    public function __construct(
        PrestationsRepository $prestationsRepository,
        PicturesRepository $picturesRepository,
        InfosContactRepository $infosContactRepository
    ) {
        $this->prestationsRepository = $prestationsRepository;
        $this->picturesRepository = $picturesRepository;
        $this->infosContactRepository = $infosContactRepository;
    }

    #[Route('/', name: 'app_home_page')]
    public function index(): Response
    {
        $prestations = $this->prestationsRepository->findAll();
        $cover = $this->picturesRepository->findBy(['type' => 'cover'], ['id' => 'DESC'], 5, null);
        $logo = $this->picturesRepository->findBy(['type' => 'logo']);
        $infosContact = $this->infosContactRepository->findAll();

        return $this->render('main/index.html.twig', [
            'prestations' => $prestations,
            'pictures' => ['logo' => $logo, 'cover' => $cover],
            'infosContact' => $infosContact,
        ]);
    }
}
