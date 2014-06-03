<?php

namespace App\Test\Entity;

use App\Entity\Room;

class RoomTest extends \PHPUnit_Framework_TestCase{

	public function testRoomMethods()
	{
		$room = new Room();
		$room->setName('Apartment');
		$room->setAdults(2);
		$room->setChildren(3);
		$room->setRoomCount(5);
		$room->setPrices("{'Monday':'40', 'Tuesday':'20'}");

		$this->assertEquals($room->getName() , 'Apartment');
		$this->assertEquals($room->getAdults() , 2);
		$this->assertEquals($room->getChildren() , 3);
		$this->assertEquals($room->getRoomCount() , 5);
		$this->assertEquals($room->getPrices() , "{'Monday':'40', 'Tuesday':'20'}");

	}
}