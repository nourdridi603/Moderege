<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuestionRepository::class)
 */
class Question
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $texte;

    /**
     * @ORM\ManyToOne(targetEntity=Sondage::class, inversedBy="Questions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sondage;

    /**
     * @ORM\OneToMany(targetEntity=Option::class, mappedBy="question", cascade={"persist"})
     */
    private $options;

    /**
     * @ORM\OneToMany(targetEntity=Reponse::class, mappedBy="questionLogique")
     */
    private $reponses;

    /**
     * @ORM\OneToMany(targetEntity=Reponse::class, mappedBy="question")
     */
    private $reponsess;

    public function __construct()
    {
        $this->options = new ArrayCollection();
        $this->reponses = new ArrayCollection();
        $this->reponsess = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(?string $texte): self
    {
        $this->texte = $texte;

        return $this;
    }

    public function getSondage(): ?Sondage
    {
        return $this->sondage;
    }

    public function setSondage(?Sondage $sondage): self
    {
        $this->sondage = $sondage;

        return $this;
    }
    public function __toString(){
        // to show the name of the Category in the select
        return $this->texte;
        // to show the id of the Category in the select
        // return $this->id;
    }

    /**
     * @return Collection|Option[]
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function addOption(Option $option): self
    {
            $this->options[] = $option;
            $option->setQuestion($this);


        return $this;
    }

    public function removeOption(Option $option): self
    {
            // set the owning side to null (unless already changed)
            if ($option->getQuestion() === $this) {
                $option->setQuestion(null);

        }

        return $this;
    }

    /**
     * @return Collection|Reponse[]
     */
    public function getReponses(): Collection
    {
        return $this->reponses;
    }

    public function addReponse(Reponse $reponse): self
    {
        if (!$this->reponses->contains($reponse)) {
            $this->reponses[] = $reponse;
            $reponse->setQuestionLogique($this);
        }

        return $this;
    }

    public function removeReponse(Reponse $reponse): self
    {
        if ($this->reponses->removeElement($reponse)) {
            // set the owning side to null (unless already changed)
            if ($reponse->getQuestionLogique() === $this) {
                $reponse->setQuestionLogique(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Reponse[]
     */
    public function getReponsess(): Collection
    {
        return $this->reponsess;
    }

    public function addReponsess(Reponse $reponsess): self
    {
        if (!$this->reponsess->contains($reponsess)) {
            $this->reponsess[] = $reponsess;
            $reponsess->setQuestion($this);
        }

        return $this;
    }

    public function removeReponsess(Reponse $reponsess): self
    {
        if ($this->reponsess->removeElement($reponsess)) {
            // set the owning side to null (unless already changed)
            if ($reponsess->getQuestion() === $this) {
                $reponsess->setQuestion(null);
            }
        }

        return $this;
    }
}
