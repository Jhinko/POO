<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
final class Bd extends Volume
{
   /**
    * @ORM\Column(length="100")
    */
   private string $designer;

   public function __construct(string $title, string $auteur, string $designer)
   {
      parent::__construct($title, $auteur);
      $this->designer = $designer;
   }


   /**
    * Get the value of designer
    */
   public function getDesigner(): string
   {
      return $this->designer;
   }

   /**
    * Set the value of designer
    *
    * @return  self
    */
   public function setDesigner(string $designer): self
   {
      $this->designer = $designer;

      return $this;
   }
}
