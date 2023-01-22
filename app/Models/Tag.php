<?php

namespace App\Models;

use App\Traits\HasUser;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory, HasUser, SoftDeletes;
    protected $fillable = ['name', 'user_id'];

    // update field
    public const UPDATE_FIELDS = ['name', 'user_id'];

    // relación
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function recipes(): BelongsToMany
    {
        return $this->belongsToMany(Recipe::class);
    }

    // rules
    public static function rules($id = 0): array
    {
        return [
            'name' => [
                'required', 'string', Rule::unique('tags')
                    ->ignore($id, 'id,deleted_at,NULL')
                    ->where(function ($query) { //Ignora por user_id
                        $query->where('user_id',auth()->id());
                    }),
            ],
        ];
    }
}
