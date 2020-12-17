<?php

namespace App\Entity;

use App\Repository\ReponseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReponseRepository::class)
 */
class Reponse
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contenu;

    /**
     * @ORM\ManyToOne(targetEntity=Question::class, inversedBy="reponses")
     * @ORM\JoinColumn(nullable=true)
     */
    private $questionLogique;

    /**
     * @ORM\ManyToOne(targetEntity=QuestionChoixMultiples::class, inversedBy="reponses")
     */
    private $questionMultiChoix;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="reponses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity=Question::class, inversedBy="reponsess")
     */
    private $question;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getQuestionLogique(): ?Question
    {
        return $this->questionLogique;
    }

    public function setQuestionLogique(?Question $questionLogique): self
    {
        $this->questionLogique = $questionLogique;

        return $this;
    }

    public function getQuestionMultiChoix(): ?QuestionChoixMultiples
    {
        return $this->questionMultiChoix;
    }

    public function setQuestionMultiChoix(?QuestionChoixMultiples $questionMultiChoix): self
    {
        $this->questionMultiChoix = $questionMultiChoix;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }
}
