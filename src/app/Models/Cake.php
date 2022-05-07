<?php

/*
 * Esse arquivo faz parte do teste técnico da empresa Checklist Fácil.
 *
 * (c) Erick Johnson Almeida de Menezes <erickmenezes.dev@gmail.com>
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Cake.
 *
 * @author ErickJMenezes <erickmenezes.dev@gmail.com>
 */
class Cake extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $guarded = [];

    public function price(): Attribute
    {
        return new Attribute(
            get: fn (int $price): float => $price === 0 ? 0 : floatval($price / 100),
            set: fn (float $price): int => intval($price * 100)
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<\App\Models\CakeSubscription>
     * @author ErickJMenezes <erickmenezes.dev@gmail.com>
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(CakeSubscription::class);
    }
}
