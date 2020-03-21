<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
     protected $fillable = [
        'project_name',
      
        'owner_name',
        'address',
        'phone_number',
        'emial_id',
        'website',
        'developer_name',
        'project_code',
        'street',
        'city_town',
        'postal_code',
        'state',
        'country',
        'description',
       
    ];


}
