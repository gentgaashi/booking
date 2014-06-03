<?php

namespace App\Entity;

//use Doctrine\ORM\Mapping as ORM;

/**
 * @Table(name="users")
 * @Entity()
 */
class User
{
    /**
     * @Column(type="integer")
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    public $id;

    /**
     * @Column(name="username", type="string", length=225)
     */
    public $username;

    /**
     * @Column(name="birthday", type="datetime", length=225, nullable=true)
     */
    public $birthday;

    /**
     * @Column(name="password", type="string", length=225)
     */
    public $password;

    /**
     * @Column(name="email", type="string", length=225)
     */
    public $email;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    public function getBirthday()
    {
        return $this->birthday;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }
}
