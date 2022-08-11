<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @var Book $book
 * @var Checkout[] $checkouts
 */
class Inventory extends Model
{
    use HasFactory;

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

    public function checkouts(): HasManyThrough
    {
        return $this->hasManyThrough(
            Checkout::class,
            Book::class
        );
    }
}
