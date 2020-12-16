<?php

namespace App\Entity;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;


use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MessageRepository::class)
 * @ORM\Table(indexes={@Index(name="created_at_index",columns={"created_at"})})
 * @HasLifecycleCallbacks()
 *
 */
class Message
{

    use Timestamp;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column (type="text")
     */
    private $content;
    /**
     * @ORM\ManyToOne(targetEntity="Utilisateur",inversedBy="messages")
     */
    private $utilisateur;
    /**
     * @ORM\ManyToOne(targetEntity="Conversation",inversedBy="messages")
     */
    private $conversation;




    public function getId(): ?int
    {
        return $this->id;
    }
}
