<?php

namespace App\Entity;

use App\Repository\CompetencesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompetencesRepository::class)]
class Competences
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text', nullable: false)]
    private $titre;

    #[ORM\Column(type: 'text', nullable: true)]
    private $realisation;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $valide;

    #[ORM\ManyToOne(targetEntity: Categorie::class, inversedBy: 'competences')]
    private $categorie;

    #[ORM\Column(type: 'date', nullable: true)]
    private $periode;

    #[ORM\Column(type: 'date', nullable: true)]
    private $periodeFin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getRealisation(): ?string
    {
        return $this->realisation;
    }

    public function setRealisation(?string $realisation): self
    {
        $this->realisation = $realisation;

        return $this;
    }

    public function getValide(): ?bool
    {
        return $this->valide;
    }

    public function setValide(?bool $valide): self
    {
        $this->valide = $valide;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getPeriode(): ?\DateTimeInterface
    {
        return $this->periode;
    }

    public function setPeriode(?\DateTimeInterface $periode): self
    {
        $this->periode = $periode;

        return $this;
    }

    public function getPeriodeFin(): ?\DateTimeInterface
    {
        return $this->periodeFin;
    }

    public function setPeriodeFin(?\DateTimeInterface $periodeFin): self
    {
        $this->periodeFin = $periodeFin;

        return $this;
    }
}
