<?php

namespace App\Entity;

use App\Interface\UserInterface;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\MappedSuperclass */
abstract class Member implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;
    
    /**
     * @ORM\Column(length="100")
    */
    private string $lastname;
    
    /**
     * @ORM\Column(length="100")
    */
    private string $firstname;

    private static $nbrMember; 

    public function __construct(string $l, string $f)
    {
        $this->lastname = $l;
        $this->firstname = $f;

        self::$nbrMember = self::$nbrMember + 1;
    }

    public static function getNumber()
    {
        return self::$nbrMember;
    }


    /**
     * Get the value of id
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Get the value of firstname
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */
    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function returnBook(): void
    {
    }

    public static  function GiveMeNumber() : int
    {
       return 3;
    }
}
