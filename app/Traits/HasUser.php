<?php

namespace App\Traits;

use App\Scopes\UserScope;


trait HasUser
{

    /**
     * Guardar por usuario
     */
    public static function bootHasUser()
    {
        static::creating(function ($model) {
            $model->user_id = auth()->id();
        });
    }

    /**
     * Filtrar por usuario
     */
    protected static function booted()
    {
        static::addGlobalScope(new UserScope);
    }
}