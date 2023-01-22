<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Recipe extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['title', 'description', 'rate', 'category_id', 'tag_id', 'user_id'];

    // update field
    public const UPDATE_FIELDS = ['title', 'description', 'rate', 'categry_id', 'tag_id', 'user_id'];

    // relación
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'tag_id');
    }


    // rules
    public static function rules($id = 0): array
    {
        return [
            'title' => [
                'required', 'string', Rule::unique('categories')
                    ->ignore($id, 'id,deleted_at,NULL')
                    ->where(function ($query) { //Ignora por user_id
                        $query->where('user_id', auth()->id());
                    }),
            ],
        ];
    }
}
