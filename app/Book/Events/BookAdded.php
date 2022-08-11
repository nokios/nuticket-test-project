<?php

namespace App\Book\Events;

use App\Book\BookId;
use DateTimeImmutable;
use DateTimeInterface;

class BookAdded
{
    public BookId $bookId;

    public string $name;

    public int $quantity;

    public DateTimeImmutable $checkedOutAt;

    public function __construct(BookId $bookId, string $name, int $quantity, ?DateTimeInterface $checkedOutAt = null)
    {
        $this->bookId = $bookId;
        $this->name = $name;
        $this->quantity = $quantity;
        $this->checkedOutAt = $checkedOutAt
            ? DateTimeImmutable::createFromInterface($checkedOutAt)
            : new DateTimeImmutable();
    }
}