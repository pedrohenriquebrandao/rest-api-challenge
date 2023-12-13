<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
// use Spatie\Permission\Traits\HasRoles;

class Producer extends Model
{
    use HasFactory;

    use HasApiTokens, HasFactory, Notifiable;

    protected $guard_name = 'api';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'socialNumber',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'
    ];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'producer_id');
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'producer_id');
    }
}
