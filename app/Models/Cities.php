<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $table = 'cities';
    protected $primaryKey = 'id_city';
    protected $keyType = 'string';
    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        'id_city',
        'name',];


        public function Partners()
        {
            return $this->hasOne('App\Models\Partners','id_city');
        }

        public function deliveryTimes()
    {
        return $this->belongsToMany(DeliveryTimes::class, 'delivery_city', 'id_city', 'id_time')->withTimestamps();
    }

}
