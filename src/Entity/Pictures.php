<?php

namespace App\Entity;

use App\Repository\PicturesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PicturesRepository::class)]
class Pictures
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\ManyToOne(inversedBy: 'picture')]
    private ?Articles $articles = null;

    #[ORM\Column(length: 255)]
    private ?string $field = null;

    #[ORM\Column(length: 255)]
    private ?string $covers = null;

    #[ORM\Column(length: 255)]
    private ?string $befores = null;

    #[ORM\Column(length: 255)]
    private ?string $afters = null;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getArticles(): ?Articles
    {
        return $this->articles;
    }

    public function setArticles(?Articles $articles): static
    {
        $this->articles = $articles;

        return $this;
    }

    public function __toString()
    {
        return $this->title ?? ''; 
    }

    public function getField(): ?string
    {
        return $this->field;
    }

    public function setField(string $field): static
    {
        $this->field = $field;

        return $this;
    }

    public function getCovers(): ?string
    {
        return $this->covers;
    }

    public function setCovers(string $covers): static
    {
        $this->covers = $covers;

        return $this;
    }

    public function getBefores(): ?string
    {
        return $this->befores;
    }

    public function setBefores(string $befores): static
    {
        $this->befores = $befores;

        return $this;
    }

    public function getAfters(): ?string
    {
        return $this->afters;
    }

    public function setAfters(string $afters): static
    {
        $this->afters = $afters;

        return $this;
    }
    
}
