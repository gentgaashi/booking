<?php

namespace App\Entity;

//use Doctrine\ORM\Mapping as ORM;

/**
 * @Table(name="booking")
 * @Entity()
 */
class Booking
{
    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    public $id;

    /**
    * @ManyToOne(targetEntity="User")
    */
    public $user;

    /**
    * @ManyToOne(targetEntity="Room")
    */
    public $room;

    /**
    * @Column(name="date_from", type="datetime") 
    */
    public $dateFrom;

    /**
    * @Column(name="date_to", type="datetime")
    */
    public $dateTo;

    public function getId()
    {
    	return $this->id;
    }

    public function setUser(User $user)
    {
    	$this->user = $user;
    	return $this;
    }

    public function getUser()
    {
    	return $this->user;
    }

    public function setRoom(Room $room)
    {
    	$this->room = $room;
    	return $this;
    }

    public function getRoom()
    {
    	return $this->room;
    }

    public function getDateFrom()
    {
    	return $this->dateFrom;
    }

    public function setDateFrom(\DateTime $dateFrom)
    {
    	$this->dateFrom = $dateFrom;
    	return $this;
    }

    public function getDateTo()
    {
    	return $this->dateTo;
    }

    public function setDateTo(\DateTime $dateTo)
    {
    	$this->dateTo = $dateTo;
    	return $this;
    }
}