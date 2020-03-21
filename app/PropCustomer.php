<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropCustomer extends Model
{
    protected $fillable = [
        'Customer_name',
        'Last_name',
        'Mobile_Number',
        'Email_Id',
        'Requirement_Type',
        'Requirement_Category',
        'property_category',
        'property_type',
        'Price_Min',
        'Price_Max',
        'Area_Min',
        'Area_Max',
        'Bath_Max',
        'Bath_Min',
        'Location',
        'Intrested_Property',
        'description',
        
        

    ];
}
