<?php

namespace App\Book;

use DateTimeInterface;

interface BookContract
{
    public function addBook(Book $book): void;

    public function hireBook(BookId $bookId): Checkout;
}