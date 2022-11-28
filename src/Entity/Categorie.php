<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Article::class)]
    private Collection $produits;

    #[ORM\OneToMany(mappedBy: 'produits', targetEntity: Article::class)]
    private Collection $Produit;

    #[ORM\Column(length: 255)]
    private ?string $nom_categ = null;

    #[ORM\OneToMany(mappedBy: 'Categorie', targetEntity: Article::class)]
    private Collection $art_categorie;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
        $this->Produit = new ArrayCollection();
        $this->art_categorie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Article $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits->add($produit);
            $produit->setCategorie($this);
        }

        return $this;
    }

    public function removeProduit(Article $produit): self
    {
        if ($this->produits->removeElement($produit)) {
            // set the owning side to null (unless already changed)
            if ($produit->getCategorie() === $this) {
                $produit->setCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getProduit(): Collection
    {
        return $this->Produit;
    }

    public function getNomCateg(): ?string
    {
        return $this->nom_categ;
    }

    public function setNomCateg(string $nom_categ): self
    {
        $this->nom_categ = $nom_categ;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArtCategorie(): Collection
    {
        return $this->art_categorie;
    }

    public function addArtCategorie(Article $artCategorie): self
    {
        if (!$this->art_categorie->contains($artCategorie)) {
            $this->art_categorie->add($artCategorie);
            $artCategorie->setCategorie($this);
        }

        return $this;
    }

    public function removeArtCategorie(Article $artCategorie): self
    {
        if ($this->art_categorie->removeElement($artCategorie)) {
            // set the owning side to null (unless already changed)
            if ($artCategorie->getCategorie() === $this) {
                $artCategorie->setCategorie(null);
            }
        }

        return $this;
    }
}
