<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShoppingList extends Model
{
    use HasFactory, HasUser, SoftDeletes;
    protected $fillable = ['name', 'user_id'];

    // update field
    public const UPDATE_FIELDS = ['name', 'user_id'];


    // rules
    public static function rules($id = 0): array
    {
        return [
            'name' => [
                'required', 'string', Rule::unique('shopping_lists')
                    ->ignore($id, 'id,deleted_at,NULL')
                    ->where(function ($query) { //Ignora por user_id
                        $query->where('user_id', auth()->id());
                    }),
            ],
        ];
    }

    // relaciones

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
