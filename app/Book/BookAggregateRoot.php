<?php

namespace App\Book;

use DateTimeImmutable;
use DateTimeInterface;
use Illuminate\Support\Str;
use InvalidArgumentException;
use App\Book\Events\BookAdded;
use App\Book\Events\BookCheckedOut;

final class BookAggregateRoot implements BookContract
{
    /** @var Book[] */
    private $books;

    /** @var object[] */
    private $pendingEvents = [];

    public function __construct(Book ...$books)
    {
        foreach ($books as $book) {
            $this->books[$book->getId()->getId()] = $book;
        }
    }

    private function findBookByName(string $name): ?Book
    {
        foreach ($this->books as $book) {
            if ($book->getName() == $name) {
                return $book;
            }
        }

        return null;
    }

    public function addBook(Book $book): void
    {
        $this->recordThat(new BookAdded(

        ));
    }

    public function hireBook(BookId $bookId, UserId $userId, CityId, $cityId): Checkout
    {
        $book = $this->books[$bookId];

        if (! $book) {
            throw new InvalidArgumentException("Book does not exist");
        }

        if ($book->getQuantity() == 0) {
            throw new InvalidArgumentException("Cannot check out this book, it is all checked out");
        }

        $this->recordThat(
            new BookCheckedOut(
                $bookId,
                $userId,
                new DateTimeImmutable(),
                $cityId
            )
            );

        return new Checkout(
            $bookId,
            $userId,
            new DateTimeImmutable(),
            $cityId
        );
    }

    private function recordThat($event)
    {
        $this->pendingEvents[] = $event;

        $this->applyEvent($event);
    }

    private function applyEvent(object $event)
    {
        $methodName = Str::studly(get_class($event));

        if (method_exists($this, "apply$methodName")) {
            $this->{$methodName}($event);
        }
    }

    private function applyBookAdded(BookAdded $event)
    {
        $existingBook = $this->findBookByName($book->getName());

        $qty = $book->getQuantity();

        if ($existingBook) {
            $qty = $existingBook->getQuantity() + $book->getQuantity();
        }

        $this->books[$book->getId()->getId()] = new Book(
            $book->getId(),
            $book->getName(),
            $qty
        );
    }

    private function applyBookCheckedOut(BookCheckedOut $event)
    {
        $this->books[$event->bookId->getId()] = new Book(
            $event->bookId,
            $book->name,
            $book->quantity - 1
        );
    }

    public function getPendingEvents(): array
    {
        return tap(
            $this->pendingEvents,
             function () {
                $this->pendingEvents = [];
            }
        );
    }
}