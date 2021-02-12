<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property-read string $token
 * @property-read int $selected_feature_id
 * @property-read Feature $selectedFeature
 * @property-read Collection $features
 * @property-read Collection $participants
 * @package App\Models
 */
class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'selected_feature_id',
    ];

    public function features()
    {
        return $this->hasMany(Feature::class);
    }

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    public function selectedFeature()
    {
        return $this->belongsTo(Feature::class, 'selected_feature_id');
    }

    public function removeFeature(Feature $feature)
    {
        if ($feature->is($this->selectedFeature)) {
            $this->update(['selected_feature_id' => null]);
        }
        $feature->delete();
        $this->refresh();
    }
}
