<?php

namespace App\Book;

use DateTimeImmutable;
use DateTimeInterface;

class Checkout
{
    private BookId $bookId;

    private UserId $userId;

    private DateTimeInterface $checkedOutAt;

    private CityId $cityId;

    public function __construct(BookId $bookId, UserId $userId, DateTimeImmutable $checkedOutAt, CityId $cityId)
    {
        $this->bookId = $bookId;
        $this->userId = $userId;
    }

    public function getBookId(): BookId
    {
        return $this->bookId;
    }

    public function getUserId(): UserId
    {
        return $this->userId;
    }

    public function getCheckedOutAt(): DateTimeInterface
    {
        return $this->checkedOutAt;
    }

    public function getCityId(): CityId
    {
        return $this->cityId;
    }
}