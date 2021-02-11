<?php


namespace App\Tests\Entity;


use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserEntityTest extends TestCase
{

    public function testValidUser()
    {
        $user = new User('tsikli1@myges.fr', 'Théo', 'Sikli', 23);
        $this->assertTrue($user->isValid());
    }

    public function testCheckMailOnEmpty()
    {
        $user = new User('', 'Théo', 'SIKLI', 30);
        $this->assertFalse($user->checkMail());
    }

    public function testCheckMailOnWrongFormat()
    {
        $user = new User('tsikli1@.com', 'theo', 'sikli', 30);
        $this->assertFalse($user->checkMail());
    }

    public function testCheckMailOnGoodFormat()
    {
        $user = new User('sikli.theo@gmail.com', 'theo', 'sikli', 30);
        $this->assertTrue($user->checkMail());
    }

    public function testCheckFirstnameOnEmpty()
    {
        $user = new User('sikli.theo@gmail.com', '', 'sikli', 30);
        $this->assertFalse($user->checkFirstname());
    }

    public function testCheckFirstname()
    {
        $user = new User('sikli.theo@gmail.com', 'theo', 'sikli', 30);
        $this->assertTrue($user->checkFirstname());
    }

    public function testCheckLastnameOnEmpty()
    {
        $user = new User('sikli.theo@gmail.com', '', '', 30);
        $this->assertFalse($user->checkLastname());
    }

    public function testCheckLastname()
    {
        $user = new User('sikli.theo@gmail.com', 'theo', 'sikli', 30);
        $this->assertTrue($user->checkLastname());
    }

    public function testCheckAgeEqualThirthteen()
    {
        $user = new User('sikli.theo@gmail.com', 'theo', 'sikli', 13);
        $this->assertTrue($user->checkAge());
    }

    public function testCheckAgeLowerThanThirthteen()
    {
        $user = new User('sikli.theo@gmail.com', 'theo', 'sikli', 8);
        $this->assertFalse($user->checkAge());
    }

    public function testCheckAgeGreaterThanThirthteen()
    {
        $user = new User('sikli.theo@gmail.com', 'theo', 'sikli', 30);
        $this->assertTrue($user->checkAge());
    }

    public function testAddToDoListOnSuccess()
    {
        $user = new User('sikli.theo@gmail.com', 'theo', 'sikli', 30);
        $this->assertTrue($user->addToDoList());
    }

    public function testAddToDoListOnFail()
    {
        $user = new User('sikli.theo@gmail.com', 'theo', 'sikli', 30);
        $user->addToDoList();
        $this->assertFalse($user->addToDoList());
    }
}