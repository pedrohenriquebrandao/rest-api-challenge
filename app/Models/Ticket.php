<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ticket extends Model
{
    use HasFactory;

    protected $guard_name = 'api';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'price',
    ];

    public function producer(): BelongsTo
    {
        return $this->BelongsTo(Producer::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function sector(): BelongsTo
    {
        return $this->BelongsTo(Sector::class);
    }

    public function batch(): BelongsTo
    {
        return $this->BelongsTo(Batch::class);
    }

    public function coupon(): BelongsTo
    {
        return $this->BelongsTo(Coupon::class);
    }
}
