<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Book\CityId;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @var Collection|HasMany|Checkout[] $checkouts
 */
class Book extends Model
{
    use HasFactory;

    public function checkouts(): HasMany
    {
        return $this->hasMany(Checkout::class);
    }

    public static function getMostPopularBookByCity(CityId $cityId): ?Book
    {
        $sql = <<<SQL
        SELECT book.*
        FROM checkouts
        LEFT JOIN books ON book_id = books.id
        WHERE city_id = ?
        GROUP BY book_id
        ORDER BY book_id DESC
        LIMIT 1
        SQL;

        $row = \DB::select(DB::raw($sql, [$cityId->getId()]));

        if ($row) {
            return new static($row);
        }

        return null;
    }

    public static function availableBooks(): Collection
    {
        $sql = <<<SQL
        SELECT book.*
        FROM books
        LEFT JOIN checkouts ON books.id = book_id
        GROUP BY books.id
        HAVING (books.quantity - count(checkouts)) > 0
        SQL;

        return \DB::select(DB::raw($sql))
            ->mapInto(static::class);
    }
}
