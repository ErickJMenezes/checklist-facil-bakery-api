<?php

/*
 * Esse arquivo faz parte do teste técnico da empresa Checklist Fácil.
 *
 * (c) Erick Johnson Almeida de Menezes <erickmenezes.dev@gmail.com>
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Cake.
 *
 * @author ErickJMenezes <erickmenezes.dev@gmail.com>
 */
class Cake extends Model
{
    use HasFactory;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<\App\Models\User>
     * @author ErickJMenezes <erickmenezes.dev@gmail.com>
     */
    public function solicitations(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            CakeSolicitation::class,
        );
    }
}
