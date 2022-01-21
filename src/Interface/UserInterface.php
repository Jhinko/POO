<?php 
namespace App\Interface;

use App\Entity\Book;

interface UserInterface {
    public function borrowBook(Book $book);
}