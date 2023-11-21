<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

   

    #[ORM\ManyToMany(targetEntity: SousCategory::class, inversedBy: 'categories')]
    private Collection $soucat;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Pictures $picture = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Articles::class)]
    private Collection $articles;

    public function __construct()
    {
        $this->soucat = new ArrayCollection();
        $this->articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }


   

    /**
     * @return Collection<int, SousCategory>
     */
    public function getSoucat(): Collection
    {
        return $this->soucat;
    }

    public function addSoucat(SousCategory $soucat): static
    {
        if (!$this->soucat->contains($soucat)) {
            $this->soucat->add($soucat);
        }

        return $this;
    }

    public function removeSoucat(SousCategory $soucat): static
    {
        $this->soucat->removeElement($soucat);

        return $this;
    }

    public function getPicture(): ?Pictures
    {
        return $this->picture;
    }

    public function setPicture(?Pictures $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection<int, Articles>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Articles $article): static
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setCategory($this);
        }

        return $this;
    }

    public function removeArticle(Articles $article): static
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getCategory() === $this) {
                $article->setCategory(null);
            }
        }

        return $this;
    }
}
