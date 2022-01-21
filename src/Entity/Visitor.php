<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Model\VisitorModel.php")
 */ 
final class Visitor extends Member
{
    /** @ORM\Column(length=140) */
    private string $piece_ident;

    public function __construct(string $l, string $f, int $piece_ident)
    {
        parent::__construct($l, $f);
        $this->piece_ident = $piece_ident;
    }

    public function getPieceIdent(): string
    {
        return $this->piece_ident;
    }

    public function setPieceIdent(int $new_value): self
    {
        $this->piece_ident = $new_value;

        return $this;
    }

    public function borrowBook(Book $book): void
    {
    }
}
