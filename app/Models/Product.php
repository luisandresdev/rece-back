<?php

namespace App\Models;

use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'completed', 'shopping_list_id'];

    // update field
    public const UPDATE_FIELDS = ['name', 'completed', 'shopping_list_id'];



    protected $casts = [
        'completed' => 'boolean',
    ];

    // reglas
    public static function rules($id = 0)
    {
        return [
            'name' => [
                'required', 'string', Rule::unique('products')
                    ->ignore($id, 'id,deleted_at,NULL'),
            ],
        ];
    }


    // relaciones
    public function shoppin_lists(): BelongsTo
    {
        return $this->belongsTo(ShoppingList::class, 'shopping_list_id');
    }
}
