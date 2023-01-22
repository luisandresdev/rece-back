<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CategoryRecipe extends Pivot
{
    protected $fillable = ['category_id', 'recipe_id'];
}
