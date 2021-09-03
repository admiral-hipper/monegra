<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Json implements CastsAttributes
{
    /** @inheritDoc */
    public function get($model, $key, $value, $attributes)
    {
        return json_decode($value, true);
    }

    /** @inheritDoc */
    public function set($model, $key, $value, $attributes)
    {
        return json_encode($value);
    }
}
