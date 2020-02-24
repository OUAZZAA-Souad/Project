<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryTimes extends Model
{
    protected $table = 'delivery_times';
    protected $primaryKey = 'id_time';
    protected $keyType = 'string';
    //protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        'id_time',
        'delivery_at',];
    

    public function cities()
    {
        return $this->belongsToMany(Cities::class, 'delivery_city', 'id_time', 'id_city')->withTimestamps();
    }
}