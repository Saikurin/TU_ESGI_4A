<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ItemRepository::class)
 */
class Item
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
    private $content;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $creationDate;

    /**
     * @ORM\ManyToOne(targetEntity=ToDoList::class, inversedBy="items")
     * @ORM\JoinColumn(nullable=false)
     */
    private $todolist;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function __construct(string $name, string $content, DateTimeImmutable $creationDate)
    {
        $this->setName($name);
        $this->setContent($content);
        $this->setCreationDate($creationDate);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreationDate(): ?DateTimeImmutable
    {
        return $this->creationDate;
    }

    public function setCreationDate(DateTimeImmutable $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getTodolist(): ?ToDoList
    {
        return $this->todolist;
    }

    public function setTodolist(?ToDoList $todolist): self
    {
        $this->todolist = $todolist;

        return $this;
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

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return (isset($this->name) && isset($this->content) && strlen($this->content) <= 1000 && isset($this->creationDate) ) ?? false;
    }

}
