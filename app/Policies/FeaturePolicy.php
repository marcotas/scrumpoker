<?php

namespace App\Policies;

use App\Models\Feature;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeaturePolicy
{
    use HandlesAuthorization;

    public function update(?User $user, Feature $feature)
    {
        return isManager();
    }
}
