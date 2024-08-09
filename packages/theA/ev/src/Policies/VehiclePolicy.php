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
        return $user->can('view_any_vehicle');
    }

    public function view(User $user, Vehicle $vehicle): bool
    {
        return $user->can('view_vehicle');
    }

    public function create(User $user): bool
    {
        return $user->can('create_vehicle');
    }

    public function update(User $user, Vehicle $vehicle): bool
    {
        return $user->can('update_vehicle');
    }

    public function delete(User $user, Vehicle $vehicle): bool
    {
        return $user->can('delete_vehicle');
    }

    public function restore(User $user, Vehicle $vehicle): bool
    {
        return $user->can('restore_vehicle');
    }

    public function forceDelete(User $user, Vehicle $vehicle): bool
    {
        return $user->can('force_delete_vehicle');
    }
}
