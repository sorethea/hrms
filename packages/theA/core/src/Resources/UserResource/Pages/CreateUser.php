<?php

namespace Sorethea\Core\Resources\UserResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Sorethea\Core\Resources\UserResource;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
