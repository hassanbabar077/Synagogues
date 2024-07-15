<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Synagogue extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'logo',
        'city_id',
        'address',
        'contact_person',
        'phone',
        'email',
        'discription'
    ];

    function city()
    {
        return $this->belongsTo(City::class);
    }
   
    public function sessionDetails()
    {
        return $this->hasMany(SessionDetail::class, 'synagogue_id');
    }
    
    function manager(){
        return $this->hasMany(Manager::class ,'synagogue_id');
    }
  
}
