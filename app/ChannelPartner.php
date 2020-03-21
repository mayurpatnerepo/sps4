<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChannelPartner extends Model
{
protected $fillable = [
        'Channel_Partner_photo',
        'Channel_Partner_Id',
        'first_name',
        'last_name',
        'Channel_Partner_email',
        'Channel_Partner_Contact',
        'gender',
        'Marital_status',
        'Date_Of_Birth',
        'blood_group',
        'Address',
        'relative_name',
        'relation',
        'relative_contact',
        'relative_address',
        'is_active',
        
        
    ];
}
