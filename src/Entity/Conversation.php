<?php

namespace App\Entity;

use App\Repository\ConversationRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;

/**
 * @ORM\Entity(repositoryClass=ConversationRepository::class)
 * @ORM\Table(indexes={@Index(name="last_message_id_index",columns={"last_message_id"})})
 */
class Conversation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    //enqueteur est le participant a la conversation
    /**
     * @ORM\OneToMany(targetEntity="Enqueteur",mappedBy="conversation")
     */
private $enqueteurs;
    /**
     * @ORM\OneToOne(targetEntity="Message")
     * @ORM\JoinColumn (name="last_message_id",referencedColumnName="id")
     */
private $last_message;
    /**
     * @ORM\OneToMany (targetEntity="Message",mappedBy="conversation")
     */
private $messages;
    public function getId(): ?int
    {
        return $this->id;
    }
}
