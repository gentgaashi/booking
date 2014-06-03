<?php

namespace App\Test\Entity;

use App\Entity\User;

class UserTest extends \PHPUnit_Framework_TestCase{

	public function testUserMethods()
	{
		$user = new User();
		$user->setUsername('Gent');
		$user->setBirthday(new \DateTime());
		$user->setPassword('123');
		$user->setEmail("gent@example.com");

		$this->assertEquals($user->getUsername() , 'Gent');
		$this->assertEquals($user->getPassword() , '123');
		$this->assertEquals($user->getEmail() , 'gent@example.com');
		$this->assertTrue($user->getBirthday() instanceOf \DateTime);
	}
}