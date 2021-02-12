<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Entity\UserOld;

class UserTest extends TestCase
{
    public function testIsValid()
    {
        $user = new UserOld('nashtheo@gmail.com', 'nashtheo', 'hedoo sikli', 30);
        $this->assertTrue($user->isValid());
    }

    public function testIsValidMustFailed()
    {
        $user = new UserOld('', 'nashtheo', 'hedoo sikli', 30);
        $this->assertFalse($user->isValid());
    }

    //MAIL
    public function testCheckMailOnEmpty()
    {
        $user = new UserOld('', 'nashtheo', 'hedoo sikli', 30);
        $this->assertFalse($user->checkMail());
    }

    public function testCheckMailOnWrongFormat()
    {
        $user = new UserOld('nashtheo@gmail.com', 'nashtheo', 'hedoo sikli', 30);
        $this->assertFalse($user->checkMail());
    }

    public function testCheckMailOnGoodFormat()
    {
        $user = new UserOld('nashtheo@gmail.com', 'nashtheo', 'hedoo sikli', 30);
        $this->assertTrue($user->checkMail());
    }

    //FIRSTNAME
    public function testCheckFirstnameOnEmpty()
    {
        $user = new UserOld('nashtheo@gmail.com', '', 'hedoo sikli', 30);
        $this->assertFalse($user->checkFirstname());
    }

    public function testCheckFirstname()
    {
        $user = new UserOld('nashtheo@gmail.com', 'nashtheo', 'hedoo sikli', 30);
        $this->assertTrue($user->checkFirstname());
    }

    //LASTNAME
    public function testCheckLastnameOnEmpty()
    {
        $user = new UserOld('nashtheo@gmail.com', '', '', 30);
        $this->assertFalse($user->checkLastname());
    }

    public function testCheckLastname()
    {
        $user = new UserOld('nashtheo@gmail.com', 'nashtheo', 'hedoo sikli', 30);
        $this->assertTrue($user->checkLastname());
    }

    //AGE
    public function testCheckAgeEqualThirthteen()
    {
        $user = new UserOld('nashtheo@gmail.com', 'nashtheo', 'hedoo sikli', 13);
        $this->assertTrue($user->checkAge());
    }

    public function testCheckAgeLowerThanThirthteen()
    {
        $user = new UserOld('nashtheo@gmail.com', 'nashtheo', 'hedoo sikli', 8);
        $this->assertFalse($user->checkAge());
    }

    public function testCheckAgeGreaterThanThirthteen()
    {
        $user = new UserOld('nashtheo@gmail.com', 'nashtheo', 'hedoo sikli', 30);
        $this->assertTrue($user->checkAge());
    }

    //TODOLIST
    public function testAddToDoListOnSuccess(){
        $user = new UserOld('nashtheo@gmail.com', 'nashtheo', 'hedoo sikli', 30);
        $this->assertTrue($user->addToDoList());
    }
    public function testAddToDoListOnFail(){
        $user = new UserOld('nashtheo@gmail.com', 'nashtheo', 'hedoo sikli', 30);
        $user->addToDoList();
        $this->assertFalse($user->addToDoList());
    }
}
