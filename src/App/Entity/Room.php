<?php

namespace App\Entity;

//use Doctrine\ORM\Mapping as ORM;

/**
 * @Table(name="room")
 * @Entity()
 */
class Room
{
    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    public $id;

    /**
     * @Column(name="name", type="string", length=225)
     */
    public $name;

    /**
     * @Column(name="adults", type="integer", length=11, nullable=true)
     */
    public $adults;

    /**
     * @Column(name="children", type="integer", length=11, nullable=true)
     */
    public $children;

    /**
     * @Column(name="room_count", type="integer", length=11, nullable=true)
     */
    public $roomCount;

    /**
    *@Column(name="prices", type="json_array")
    */
    public $prices;

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setAdults($adults)
    {
        $this->adults = $adults;
        return $this;
    }

    public function getAdults()
    {
        return $this->adults;
    }

    public function setChildren($children)
    {
        $this->children  = $children;
        return $this;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function setRoomCount($roomCount)
    {
        $this->roomCount = $roomCount;
        return $this;
    }

    public function getRoomCount()
    {
        return $this->roomCount;
    }

    public function setPrices($prices)
    {
        $this->prices = $prices;
    }

    public function getPrices()
    {
        return $this->prices;
    }
  }