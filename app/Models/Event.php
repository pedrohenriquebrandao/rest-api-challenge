<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $guard_name = 'api';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'city',
        'location'
    ];

    public function producer(): BelongsTo
    {
        return $this->belongsTo(Producer::class);
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'event_id');
    }
}
