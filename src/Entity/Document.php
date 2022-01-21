<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\MappedSuperclass
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="unique_book_details", fields={"title", "author"})})
 */
abstract class Document {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private string $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

        /**
     * Get the value of name
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the value of Title
     *
     * @return  self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }


    /**
     * Get the value of id
     */ 
    public function getId() : int
    {
        return $this->id;
    }
}