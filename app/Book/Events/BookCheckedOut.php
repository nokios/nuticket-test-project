<?php

namespace App\Book\Events;

use App\Book\BookId;
use App\Book\UserId;
use App\Book\CityId;
use DateTimeInterface;

class BookCheckedOut
{
    public BookId $bookId;

    public UserId $userId;

    public DateTimeInterface $checkedOutAt;

    public CityId $cityId;

    public function __construct(BookId $bookId, UserId $userId, DateTimeInterface $checkedOutAt, CityId $cityId)
    {
        $this->bookId = $bookId;
        $this->userId = $userId;
        $this->checkedOutAt = $checkedOutAt;
        $this->cityId = $cityId;
    }
}