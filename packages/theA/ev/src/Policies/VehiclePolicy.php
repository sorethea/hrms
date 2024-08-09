<?php

namespace Sorethea\Ev\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Sorethea\Core\Models\User;
use Sorethea\Ev\Models\Vehicle;

class VehiclePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Vehicle $vehicle): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Vehicle $vehicle): bool
    {
    }

    public function delete(User $user, Vehicle $vehicle): bool
    {
    }

    public function restore(User $user, Vehicle $vehicle): bool
    {
    }

    public function forceDelete(User $user, Vehicle $vehicle): bool
    {
    }
}
