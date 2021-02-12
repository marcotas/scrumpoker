<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property-read string $value
 * @property-read int $feature_id
 * @property-read int $participant_id
 * @property-read Feature $feature
 * @property-read Participant $participant
 * @property-read Carbon\Carbon $created_at
 * @property-read Carbon\Carbon $updated_at
 * @package App\Models
 */
class EstimatePoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'feature_id',
        'participant_id',
    ];

    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }
}
