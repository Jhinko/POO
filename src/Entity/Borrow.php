<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use \DateTime;

/**
 * @ORM\Entity
 */
final class Borrow
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private string $id;

    /**
     * @ORM\Column(type="datetime")
     */

    private DateTime $borrow_date;

    /**
     * @ORM\Column(length="8")
     */
    private string $delay = "+2 weeks";


    /**
     * @ORM\ManyToOne(targetEntity="Member")
     * @ORM\JoinColumn(name="member_id", referencedColumnName="id")
     */
    private Member $member;

    /**
     * @ORM\ManyToOne(targetEntity="Book")
     * @ORM\JoinColumn(name="book_id", referencedColumnName="id")
     * @var Book $book
     */
    private Book $book;

    /**
     * @
     */
    public function __construct(DateTime $borrow_date, Member $member, Book $book)
    {
        $this->borrow_date = $borrow_date;
        $this->member = $member;
        $this->book = $book;
    }

    /**
     * Get the value of return_date
     */
    public function getReturn_date(): DateTime
    {
        return $this->borrow_date->modify($this->getReturnDelay());;
    }

    /**
     * Set the value of return_date
     * @param string $dOW day(s) or week(s)
     * @return self
     */
    public function setReturn_date(int $nbr, string $dOW): self
    {
        $dOW = $nbr > 1 ? str_replace("s", "", $dOW) . 's' : str_replace("s", "", $dOW);
        $this->delay = "+$nbr $dOW";

        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of borrow_date
     */
    public function getBorrow_date()
    {
        return $this->borrow_date;
    }

    private  function getReturnDelay(): string
    {
        return $this->delay;
    }
}
