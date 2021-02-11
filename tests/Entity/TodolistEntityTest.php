<?php


namespace App\Tests\Entity;


use App\Entity\ToDoList;
use App\Entity\User;

class TodolistEntityTest
{

    /**
     * @var User
     */
    private User $user;

    public function __construct()
    {
        $this->user = new User('hedoo.theo@gmail.com', 'theo', 'sikli', 30);
    }

    private function todoList(): ToDoList
    {
        return new ToDoList($this->user);
    }
}