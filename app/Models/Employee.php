<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable =[
        "name",
        "date_of_birth",
        "position",
        "gender",
        "hired_date",
        "code",
        "last_working_date",
        "probation",
        "active",
    ];
    protected $appends =[
        "probation"
    ];
    public function getProbationAttribute(): bool {
        return Carbon::make($this->hired_date)->between(now()->subMonth(3),now());
    }
}
