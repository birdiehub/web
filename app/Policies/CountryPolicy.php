<?php

namespace App\Policies;

use App\Models\Country;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CountryPolicy
{
    use HandlesAuthorization;


    public function viewCountries(User $user): bool
    {
        return $user->hasPermissionTo('view-countries-list');
    }

    public function viewCountry(User $user): bool
    {
        return $user->hasPermissionTo('view-countries-details');
    }

    public function editCountry(User $user): bool
    {
        return $user->hasPermissionTo('edit-countries');
    }

    public function deleteCountry(User $user): bool
    {
        return $user->hasPermissionTo('delete-countries');
    }


    public function createCountry(User $user): bool
    {
        return $user->hasPermissionTo('create-countries');
    }

}
