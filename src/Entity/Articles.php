<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticlesRepository::class)]
class Articles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 5000)]
    private ?string $contenu = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu = null;

    #[ORM\OneToMany(mappedBy: 'articles', targetEntity: Pictures::class,cascade:["persist"])]
    private Collection $picture;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    private ?Category $category = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    private ?User $user = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updateAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    // Nouvelles propriétés ajoutées
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cover;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $before;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $after;

    public function __construct()
    {
        $this->picture = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * @return Collection<int, Pictures>
     */
    public function getPicture(): Collection
    {
        return $this->picture;
    }

    public function addPicture(Pictures $picture): self
    {
        if (!$this->picture->contains($picture)) {
            $this->picture->add($picture);
            $picture->setArticles($this);
        }

        return $this;
    }

    public function removePicture(Pictures $picture): self
    {
        if ($this->picture->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getArticles() === $this) {
                $picture->setArticles(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->updateAt;
    }

    public function setUpdateAt(?\DateTimeImmutable $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    // Nouvelles getters et setters pour les propriétés ajoutées

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(?string $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    public function getBefore(): ?string
    {
        return $this->before;
    }

    public function setBefore(?string $before): self
    {
        $this->before = $before;

        return $this;
    }

    public function getAfter(): ?string
    {
        return $this->after;
    }

    public function setAfter(?string $after): self
    {
        $this->after = $after;

        return $this;
    }
}
