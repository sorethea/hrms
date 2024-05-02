<?php

namespace App\Models;

use App\Observers\LeaveObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

#[ObservedBy([LeaveObserver::class])]
class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        "employee_id",
        "from",
        "to",
        "type",
        "reason",
        "allowance",
        "status",
    ];

    public function employee(): BelongsTo{
        return $this->belongsTo(Employee::class);
    }

    public function transactions(): MorphMany{
        return $this->morphMany(Transaction::class,'reference');
    }

}
