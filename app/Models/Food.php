<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Sorethea\Restaurant\Models\Category;
use Sorethea\Restaurant\Models\Restaurant;

class Food extends Model
{
    use HasFactory;

    protected $fillable =[
        "name",
        "image",
        "restaurant_id",
        "category_id",
        "description",
    ];

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function prices(): MorphMany
    {
        return $this->morphMany(Price::class,'model');
    }
}
