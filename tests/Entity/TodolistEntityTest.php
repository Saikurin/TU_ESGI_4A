<?php


namespace App\Tests\Entity;


use App\Entity\Item;
use App\Entity\ToDoList;
use App\Entity\User;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class TodolistEntityTest extends TestCase
{

    /**
     * @var User
     */
    private User $user;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->user = new User('hedoo.theo@gmail.com', 'theo', 'sikli', 30);
    }

    private function todoList(): ToDoList
    {
        return new ToDoList($this->user);
    }


    public function testAddUniqueItem()
    {
        $item = new Item('Item', 'Lorem ipsum dolor sit amet', new DateTimeImmutable());
        $toDoList = $this->todoList();
        $this->assertTrue($toDoList->isUnique($item));
    }

    public function testAddNonUniqueItem()
    {
        $item = new Item('Item', 'Lorem ipsum dolor sit amet', new DateTimeImmutable());
        $item2 = new Item('Item', 'Lorem ipsum dolor sit amet', new DateTimeImmutable());
        $toDoList = $this->todoList();
        $toDoList->canAddItem($item);
        $this->assertFalse($toDoList->isUnique($item2));
    }

    public function testCheckMaxSize()
    {
        $toDoList = $this->todoList();
        for ($i = 0; $i < 11; $i++) {
            $toDoList->addItem(new Item('Item' . $i, 'Lorem ipsum dolor sit amet', new DateTimeImmutable()));
        }
        $this->assertFalse($toDoList->checkMaxSize());
    }

    public function testCheckMinSize()
    {
        $toDoList = $this->todoList();
        $this->assertTrue($toDoList->checkMaxSize());
    }

    public function testCheckWaitingTimeOnSuccess()
    {
        $DateTimeImmutable = new DateTimeImmutable();
        $DateTimeImmutable->modify('- 30 minutes');
        $toDoList = $this->todoList();
        $toDoList->addItem(new Item('Item', 'Lorem ipsum dolor sit amet', $DateTimeImmutable));
        $this->assertTrue($toDoList->checkWaitingTime());
    }

    public function testCheckWaitingTimeOnFail()
    {
        $DateTimeImmutable = new DateTimeImmutable();
        $DateTimeImmutable->modify('- 10 minutes');
        $toDoList = $this->todoList();
        $toDoList->addItem(new Item('Item', 'Lorem ipsum dolor sit amet', $DateTimeImmutable));
        $this->assertFalse($toDoList->checkWaitingTime());
    }

    public function testCanAddItemReturnNull()
    {
        $toDoList = $this->todoList();
        $item = new Item('Item', 'Lorem ipsum dolor sit amet', new DateTimeImmutable());
        $item2 = new Item('Item', 'Lorem ipsum dolor sit amet', new DateTimeImmutable());
        $toDoList->canAddItem($item);
        $this->assertEquals(null, $toDoList->canAddItem($item2));
    }

    public function testCanAddItemOnSuccess()
    {
        $toDoList = $this->todoList();
        $item = new Item('Item', 'Lorem ipsum dolor sit amet', new DateTimeImmutable());
        $item2 = new Item('Item2', 'Lorem ipsum dolor sit amet', new DateTimeImmutable());
        $toDoList->canAddItem($item);
        $this->assertEquals(null, $toDoList->canAddItem($item2));
    }

}