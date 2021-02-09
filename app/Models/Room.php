<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read string $token
 * @package App\Models
 */
class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
    ];

    public function features()
    {
        return $this->hasMany(Feature::class);
    }
}
