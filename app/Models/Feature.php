<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property-read string $name
 * @property-read int $room_id
 * @property-read Carbon $completed_at
 * @property-read Carbon $revealed_at
 * @package App\Models
 */
class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function scopeCompleted(Builder $query)
    {
        $query->whereNotNull('completed_at');
    }

    public function scopeUncompleted(Builder $query)
    {
        $query->whereNull('completed_at');
    }

    public function uncomplete()
    {
        $this->forceFill([
            'completed_at' => null,
        ])->save();
    }

    public function complete()
    {
        $this->forceFill([
            'completed_at' => now(),
        ])->save();
    }

    public function isCompleted()
    {
        return !! $this->completed_at;
    }

    public function isRevealed()
    {
        return !! $this->revealed_at;
    }
}
