<?php

namespace App\Models;

use App\Observers\LeaveObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
#[ObservedBy([LeaveObserver::class])]
class Leave extends Model
{
    use HasFactory;

//    public static function boot(){
//        parent::boot();
//        Leave::observe(new LeaveObserver);
//    }

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

    public function transactions(): HasMany{
        return $this->hasMany(LeaveTransaction::class,'transaction_id');
    }

}
