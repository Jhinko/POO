<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/** 
 * @ORM\MappedSuperclass 
 * */
abstract class Volume extends Document
{
    /**
     * @ORM\Column(length="100")
     */
    private string $author;

    /**
     * @param string $title Titre du volume
     */
    public function __construct(string $title, string $author)
    {
        parent::__construct($title);
        $this->author = $author;
    }

    /**
     * Get the value of author
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * Set the value of author
     *
     * @return  self
     */
    public function setAuthor(string $author) : self
    {
        $this->author = $author;

        return $this;
    }
}
