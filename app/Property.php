<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
     protected $fillable = [
        'property_owner_name',
        'property_code',
        'property_name',
        'property_category',
        'listing_type',
        'listing_category',
        'prop_property_category',
        'property_type',
        'area_sqft',
        'bedroom',
        'bathroom',
        'Parking_space',
        'Project_name',
        'floor',
        'property_status',
        'property_active',
        'property_image',
        'street',
        'city_town',
        'postal_code',
        'state',
        'country',
        'unit_price',
        'deposite_money',
        'listing_owner_lanloard_company',
        'listing_owner',
        'new_owner_lanloard_company',
        'new_owner_landloard_contact',
        'description',
       
    ];
}
