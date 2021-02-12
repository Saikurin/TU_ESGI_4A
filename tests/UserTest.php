<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Entity\UserOld;

class UserTest extends TestCase
{
    public function testIsValid()
    {
<<<<<<< HEAD
        $user = new UserOld('nashtheo@gmail.com', 'nashtheo', 'hedoo sikli', 30);
=======
        $user = new UserOld('dehaut.alix@gmail.com', 'alix', 'de Haut', 30);
>>>>>>> 10f18147a8b765ec386570635ec0842709851989
        $this->assertTrue($user->isValid());
    }

    public function testIsValidMustFailed()
    {
<<<<<<< HEAD
        $user = new UserOld('', 'nashtheo', 'hedoo sikli', 30);
=======
        $user = new UserOld('', 'alix', 'de Haut', 30);
>>>>>>> 10f18147a8b765ec386570635ec0842709851989
        $this->assertFalse($user->isValid());
    }

    //MAIL
    public function testCheckMailOnEmpty()
    {
<<<<<<< HEAD
        $user = new UserOld('', 'nashtheo', 'hedoo sikli', 30);
=======
        $user = new UserOld('', 'alix', 'de Haut', 30);
>>>>>>> 10f18147a8b765ec386570635ec0842709851989
        $this->assertFalse($user->checkMail());
    }

    public function testCheckMailOnWrongFormat()
    {
<<<<<<< HEAD
        $user = new UserOld('nashtheo@gmail.com', 'nashtheo', 'hedoo sikli', 30);
=======
        $user = new UserOld('dehaut.alix@.com', 'alix', 'de Haut', 30);
>>>>>>> 10f18147a8b765ec386570635ec0842709851989
        $this->assertFalse($user->checkMail());
    }

    public function testCheckMailOnGoodFormat()
    {
<<<<<<< HEAD
        $user = new UserOld('nashtheo@gmail.com', 'nashtheo', 'hedoo sikli', 30);
=======
        $user = new UserOld('dehaut.alix@gmail.com', 'alix', 'de Haut', 30);
>>>>>>> 10f18147a8b765ec386570635ec0842709851989
        $this->assertTrue($user->checkMail());
    }

    //FIRSTNAME
    public function testCheckFirstnameOnEmpty()
    {
<<<<<<< HEAD
        $user = new UserOld('nashtheo@gmail.com', '', 'hedoo sikli', 30);
=======
        $user = new UserOld('dehaut.alix@gmail.com', '', 'de Haut', 30);
>>>>>>> 10f18147a8b765ec386570635ec0842709851989
        $this->assertFalse($user->checkFirstname());
    }

    public function testCheckFirstname()
    {
<<<<<<< HEAD
        $user = new UserOld('nashtheo@gmail.com', 'nashtheo', 'hedoo sikli', 30);
=======
        $user = new UserOld('dehaut.alix@gmail.com', 'alix', 'de Haut', 30);
>>>>>>> 10f18147a8b765ec386570635ec0842709851989
        $this->assertTrue($user->checkFirstname());
    }

    //LASTNAME
    public function testCheckLastnameOnEmpty()
    {
<<<<<<< HEAD
        $user = new UserOld('nashtheo@gmail.com', '', '', 30);
=======
        $user = new UserOld('dehaut.alix@gmail.com', '', '', 30);
>>>>>>> 10f18147a8b765ec386570635ec0842709851989
        $this->assertFalse($user->checkLastname());
    }

    public function testCheckLastname()
    {
<<<<<<< HEAD
        $user = new UserOld('nashtheo@gmail.com', 'nashtheo', 'hedoo sikli', 30);
=======
        $user = new UserOld('dehaut.alix@gmail.com', 'alix', 'de Haut', 30);
>>>>>>> 10f18147a8b765ec386570635ec0842709851989
        $this->assertTrue($user->checkLastname());
    }

    //AGE
    public function testCheckAgeEqualThirthteen()
    {
<<<<<<< HEAD
        $user = new UserOld('nashtheo@gmail.com', 'nashtheo', 'hedoo sikli', 13);
=======
        $user = new UserOld('dehaut.alix@gmail.com', 'alix', 'de Haut', 13);
>>>>>>> 10f18147a8b765ec386570635ec0842709851989
        $this->assertTrue($user->checkAge());
    }

    public function testCheckAgeLowerThanThirthteen()
    {
<<<<<<< HEAD
        $user = new UserOld('nashtheo@gmail.com', 'nashtheo', 'hedoo sikli', 8);
=======
        $user = new UserOld('dehaut.alix@gmail.com', 'alix', 'de Haut', 8);
>>>>>>> 10f18147a8b765ec386570635ec0842709851989
        $this->assertFalse($user->checkAge());
    }

    public function testCheckAgeGreaterThanThirthteen()
    {
<<<<<<< HEAD
        $user = new UserOld('nashtheo@gmail.com', 'nashtheo', 'hedoo sikli', 30);
=======
        $user = new UserOld('dehaut.alix@gmail.com', 'alix', 'de Haut', 30);
>>>>>>> 10f18147a8b765ec386570635ec0842709851989
        $this->assertTrue($user->checkAge());
    }

    //TODOLIST
    public function testAddToDoListOnSuccess(){
<<<<<<< HEAD
        $user = new UserOld('nashtheo@gmail.com', 'nashtheo', 'hedoo sikli', 30);
        $this->assertTrue($user->addToDoList());
    }
    public function testAddToDoListOnFail(){
        $user = new UserOld('nashtheo@gmail.com', 'nashtheo', 'hedoo sikli', 30);
=======
        $user = new UserOld('dehaut.alix@gmail.com', 'alix', 'de Haut', 30);
        $this->assertTrue($user->addToDoList());
    }
    public function testAddToDoListOnFail(){
        $user = new UserOld('dehaut.alix@gmail.com', 'alix', 'de Haut', 30);
>>>>>>> 10f18147a8b765ec386570635ec0842709851989
        $user->addToDoList();
        $this->assertFalse($user->addToDoList());
    }
}
