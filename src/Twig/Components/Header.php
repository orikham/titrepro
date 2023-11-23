<?php
// src/Twig/Components/Header.php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use App\Repository\PicturesRepository;

#[AsTwigComponent]
class Header
{
    private $picturesRepository;


    public function __construct(PicturesRepository $picturesRepository) 
    {
        $this->picturesRepository = $picturesRepository;
    }

    public function getLogo()
    {
        $pictures = $this->picturesRepository->findBy(['type' => 'logo']);

        return [
                'logo' => $pictures,
            ];
    }
}