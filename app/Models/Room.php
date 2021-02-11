<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read string $token
 * @property-read string $selected_feature_id
 * @property-read Feature $selectedFeature
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
    }
}
