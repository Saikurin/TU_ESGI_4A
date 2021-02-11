<?php

namespace App\Entity;

use App\Repository\ToDoListRepository;
use DateTime;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToMany(targetEntity=Item::class, mappedBy="todolist", orphanRemoval=true)
     */
    private $items;

    public function __construct(User $user)
    {
        $this->creator = $user;
        $this->items = new ArrayCollection();
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

    /**
     * @return Collection|Item[]
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    /**
     * @param Item $item
     * @return $this
     */
    public function addItem(Item $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setTodolist($this);
        }

        return $this;
    }

    /**
     * @param Item $item
     * @return $this
     */
    public function removeItem(Item $item): self
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getTodolist() === $this) {
                $item->setTodolist(null);
            }
        }

        return $this;
    }

    /**
     * @param Item $item
     * @return $this|null
     */
    public function canAddItem(Item $item): ?ToDoList
    {
        if ($this->isUnique($item) && $this->checkMaxSize() && $this->checkWaitingTime()){
            // Send mail
            return $this->addItem($item);
        }
        return null;
    }

    /**
     * @return bool
     */
    public function checkWaitingTime(): bool
    {
        if (!isset($this->lastCreationItem)) return true;

        $now = new DateTime('NOW');
        $interval = $now->getTimestamp() - $this->lastCreationItem->getTimestamp();
        $waitingTime = 30 * 60;
        return $interval >= $waitingTime;
    }

    /**
     * @param Item $newItem
     * @return bool
     */
    public function isUnique(Item $newItem): bool
    {
        foreach ($this->items as $item){
            if ($item->getName() == $newItem->getName()){
                return false;
            }
        }
        return true;
    }

    /**
     * @return bool
     */
    public function checkMaxSize(): bool
    {
        return (count($this->items) >= 0) && (count($this->items) <= 10);
    }
}
