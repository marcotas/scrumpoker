<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property-read int $room_id
 * @property-read string $name
 * @property-read Room $room
 * @property-read Collection $estimatePoints
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

    public function estimatePoints()
    {
        return $this->hasMany(EstimatePoint::class);
    }

    public function vote(Feature $feature, $value): EstimatePoint
    {
        $estimatePoint = $this->estimatePoints()
            ->firstOrCreate([
                'feature_id' => $feature->id,
            ], [
                'value' => $value
            ]);
        $estimatePoint->update(compact('value'));

        return $estimatePoint;
    }

    public function getEstimatePoint(Feature $feature): ?EstimatePoint
    {
        return $this->estimatePoints()
            ->whereFeatureId($feature->id)
            ->first();
    }
}
