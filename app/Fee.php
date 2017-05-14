<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    //vehicleTypes
    const VEHICLE_TYPE_SMALL_VAN = 1;
    const VEHICLE_TYPE_SWB = 2;
    const VEHICLE_TYPE_LWB = 3;
    const VEHICLE_TYPE_LUTON = 4;
    const VEHICLE_TYPE_ARCTIC = 5;
    const VEHICLE_TYPE_SPECIAL = 6;

    const FEE_TYPE_PER_MILE = 1;

    public function feeScale() {
        return $this->belongsTo(FeeScale::class);
    }
}
