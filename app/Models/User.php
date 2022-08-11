<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function checkouts(): HasMany
    {
        return $this->hasMany(Checkout::class);
    }

    public function overdueCheckouts(): HasMany
    {
        return $this->checkouts()
            ->whereNull('returned_at')
            ->whereRaw("DATE_ADD(checked_out_at, INTERVAL 2 WEEKS) > CURDATE()");
    }

    public function scopeHasOverdueBooks(Builder $query): void
    {
        return static::overdueCheckouts()->get();
    }

    public static function getUsersWithOverdueBooks()
    {
        $sql = <<<SQL
        SELECT users.id
        FROM users
        JOIN checkouts ON users.id = checkouts.user_id
        WHERE returned_at IS NULL
          AND DATE_ADD(checked_out_at, INTERVAL 2 WEEKS) > CURDATE()
        GROUP BY users.id
        SQL;

        return static::whereIn('id', \DB::select(DB::raw($sql)));
    }
}
