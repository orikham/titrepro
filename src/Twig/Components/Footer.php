<?php
// src/Twig/Components/Footer.php
namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;


use App\Repository\InfosContactRepository;

#[AsTwigComponent]
class Footer
{
    
    private $infosContactRepository;
    

    public function __construct(InfosContactRepository $infosContactRepository) 
    {
        
        $this->infosContactRepository = $infosContactRepository;
    }

  
    public function getfooter()
    {
        $infosContact = $this->infosContactRepository->findAll();
        return [
            'infosContact' => $infosContact,
        ];
    }
}
