<?php

namespace App\Entity;

use App\Repository\ToDoListRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ToDoListRepository::class)
 */
class ToDoList
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $name;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private ?DateTimeImmutable $lastItemCreation;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="todolist")
     * @ORM\JoinColumn(nullable=false)
     */
    private User $creator;

    public function __construct(User $user)
    {
        $this->creator = $user;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLastItemCreation(): ?DateTimeImmutable
    {
        return $this->lastItemCreation;
    }

    public function setLastItemCreation(?DateTimeImmutable $lastItemCreation): self
    {
        $this->lastItemCreation = $lastItemCreation;

        return $this;
    }

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    public function setCreator(User $creator): self
    {
        $this->creator = $creator;

        return $this;
    }
}
