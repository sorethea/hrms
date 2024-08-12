<?php

namespace Sorethea\Ev\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Sorethea\Core\Models\User;

class Vehicle extends Model
{
    protected $fillable =[ "user_id", "make", "model", "plate", "year", "images"];
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
