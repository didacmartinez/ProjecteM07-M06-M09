<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Place;

class PlacePolicy
{
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Place $place)
    {
        return $place['visibility_id'] == 1 || ($place['visibility_id'] == 3 && $place->user->is(auth()->user())) ||auth()->user()->role_id == 2;
    }

    public function create(User $user)
    {
        return $user->role_id === 1;
    }

    public function update(User $user, Place $place)
    {
        return $user->id === $place->author_id || $user->role_id === 2;
    }

    public function delete(User $user, Place $place)
    {
        return  $user->id === $place->author_id;
    } 
    
    public function Favorite(User $user, Place $place)
    {
        return $user->role_id === 1;
    }

}