<?php

namespace Sorethea\Ev\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Sorethea\Core\Models\User;

class Vehicle extends Model
{
    protected $fillable =[ "user_id", "make", "model", "plate", "year", "images"];

    protected $casts = [
        "user_id" => "int",
        "make" => "string",
        "model" => "string",
        "year" => "integer",
        "plate" => "string",
        "images" => "array"
    ];
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
