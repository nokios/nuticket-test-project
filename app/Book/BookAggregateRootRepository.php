<?php

namespace App\Book;

use App\Book\Events\BookAdded;
use App\Book\Events\BookCheckedOut;
use App\Models\Inventory;
use App\Models\Checkout as CheckoutModel;

class BookAggregateRootRepository
{
    public function get(): BookAggregateRoot
    {
        $books = Inventory::with(['book'])
            ->withCount('checkouts')
            ->all()
            ->map(function (Inventory $inventory) {
                return new Book(
                    new BookId($inventory->book_id),
                    $inventory->book->name,
                    $inventory->quantity - $inventory->checkouts_count
                )
            });
        
        return new BookAggregateRoot(...$books);
    }

    public function persist(BookAggregateRoot $bookAggregateRoot)
    {
        foreach ($bookAggregateRoot->getPendingEvents() as $event) {
            switch (get_class($event)) {
                case BookAdded::class:
                    $this->addOrUpdateBook($event);
                    break;
                case BookCheckedOut::class:
                    $this->createCheckoutRecord($event);
                    break;
            }
        }
    }

    private function addOrUpdateBook(BookAdded $event): void
    {
        $book = Book::find($event->bookId->getId());

        if (! $book) {
            $book = Book::create([
                'id' => $event->bookId->getId(),
                'name' => $event->name,
                'quantity' => $event->quantity
            ]);
        }

        $book->update([
            'quantity' => $event->quantity
        ]);
    }

    private function createCheckoutRecord(BookCheckedOut $event): void
    {
        CheckoutModel::create([
            'book_id' => $event->bookId->getId(),
            'user_id' => $event->userId->getId(),
            'checked_out_at' => $event->checkedOutAt,
            'city_id' => $event->cityId
        ]);
    }
}