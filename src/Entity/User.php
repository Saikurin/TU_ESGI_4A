<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $lastname;

    /**
     * @ORM\Column(type="integer")
     * @Assert\GreaterThanOrEqual(13)
     */
    private $age;

    /**
     * @ORM\OneToMany(targetEntity=ToDoList::class, mappedBy="creator", orphanRemoval=true)
     */
    private $todolist;

    /**
     * User constructor.
     * @param string $email
     * @param string $firstname
     * @param string $lastname
     * @param int $age
     */
    public function __construct(string $email, string $firstname, string $lastname, int $age)
    {
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->age = $age;
        $this->todolist = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string)$this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string)$this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->checkMail() && $this->checkFirstname() && $this->checkLastname() && $this->checkAge();
    }

    /**
     * @return bool
     */
    public function checkMail(): bool
    {
        if (isset($this->email) && filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function checkFirstname(): bool
    {
        return (isset($this->firstname) && strlen($this->firstname) > 0) ?? false;
    }

    /**
     * @return bool
     */
    public function checkLastname(): bool
    {
        return (isset($this->lastname) && strlen($this->lastname) > 0) ?? false;
    }

    /**
     * @return bool
     */
    public function checkAge(): bool
    {
        return isset($this->age) && is_int($this->age) && $this->age >= 13;
    }

    /**
     * @return Collection|ToDoList[]
     */
    public function getTodolist(): Collection
    {
        return $this->todolist;
    }

    public function removeTodolist(ToDoList $todolist): self
    {
        if ($this->todolist->removeElement($todolist)) {
            // set the owning side to null (unless already changed)
            if ($todolist->getCreator() === $this) {
                $todolist->setCreator(null);
            }
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function addToDoList(): bool
    {
        if (isset($this->toDoList)) return false;
        $this->toDoList = new ToDoList($this);
        return true;
    }

}
