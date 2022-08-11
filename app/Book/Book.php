<?php

namespace App\Book;

class Book
{
    private BookId $id;

    private string $name;

    private int $quantity;

    public function __construct(BookId $id, string $name, int $quantity)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): BookId
    {
        return $this->id;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}