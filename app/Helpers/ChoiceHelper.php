<?php

namespace App\Helpers;

use App\Fee;

class ChoiceHelper
{
    public static function getVehicleTypeChoices() {
        return [
            Fee::VEHICLE_TYPE_SMALL_VAN => 'Small Van',
            Fee::VEHICLE_TYPE_SWB => 'SWB Van',
            Fee::VEHICLE_TYPE_LWB => 'LWB Van',
            Fee::VEHICLE_TYPE_LUTON => 'Luton',
            Fee::VEHICLE_TYPE_ARCTIC => 'Arctic',
            Fee::VEHICLE_TYPE_SPECIAL => 'Special',
        ];
    }
}
