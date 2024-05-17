<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Sorethea\Restaurant\Models\PriceGroup;

class Price extends Model
{
    use HasFactory;
    protected $fillable =[
        "price_group_id",
        "price",
    ];

    public function priceGroup(): BelongsTo
    {
        return $this->belongsTo(PriceGroup::class);
    }
    public function model(): MorphTo
    {
        return $this->morphTo('model');
    }
}
