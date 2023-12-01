<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\InfosContactRepository;
use App\Repository\MessagerieRepository;

class ContactController extends AbstractController
{
    

    private $infosContactRepository;
    private $messagerieRepository;


    public function __construct(InfosContactRepository $infosContactRepository, MessagerieRepository $messagerieRepository
    ) {
        
        $this->infosContactRepository = $infosContactRepository;
        $this->messagerieRepository = $messagerieRepository;
    }

    #[Route('/contact/', name: 'app_contact')]
    public function infoContact()
        {
            $infosContact = $this->infosContactRepository->findAll();
            return $this->render('contact/contact.html.twig',[
                'infosContact' => $infosContact,
            ]);
        }


    
   
}

    
   
    

    

  
    
