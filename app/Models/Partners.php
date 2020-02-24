<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    protected $table = 'partners';
    protected $primaryKey = 'id_partner';
    protected $keyType = 'string';
    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        'id_partner',
        'name',
        'products'];
    

    public function Cities()
{
    return $this->belongsTo('App\Models\Cities','id_city');
}
}