<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property-read int $room_id
 * @property-read string $name
 * @property-read Room $room
 * @property-read Carbon\Carbon $created_at
 * @property-read Carbon\Carbon $updated_at
 * @package App\Models
 */
class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'room_id',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
