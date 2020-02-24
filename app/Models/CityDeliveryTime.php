<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CityDeliveryTime extends Model
{
    protected $table = 'delivery_city';

    function cities()
    {
        return $this->hasOne(Cities::class, 'id_city', 'id_city');
    }

    function deliveryTimes()
    {
        return $this->hasOne(DeliveryTimes::class, 'id_time', 'id_time');
    }
}
