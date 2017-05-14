<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeeScale extends Model
{
    public function fees() {
        return $this->hasMany(Fee::class);
    }
}
