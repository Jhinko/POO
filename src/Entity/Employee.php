<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
final class Employee extends Member {

    /**
     * @ORM\Column(type="integer")
    */
    private int $badge_number;

    public function __construct(string $l, string $f, int $b_n)
    {
        parent::__construct($l, $f);
        $this->badge_number = $b_n; 
    }

    /**
     * Get the value of badge_number
     */ 
    public function getBadge_number() : int
    {
        return $this->badge_number;
    }

    /**
     * Set the value of badge_number
     *
     * @return  self
     */ 
    public function setBadge_number($badge_number) : self
    {
        $this->badge_number = $badge_number;

        return $this;
    }

    public function borrowBook(Book $book) : void
    {
        
    }

}