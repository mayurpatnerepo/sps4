<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
     protected $fillable = [
        'Lead_Name',
        'Mobile_Number',
        'Phone',
        'Email_Id',
        'Secondary_Email',
        'Skype_Id',
        'Twitter',
        'Lead_Status',
        'Lead_Source',
        'Modified_By',
        'Created_By',
        'Requirement_Type',
        'Requirement_Category',
        'Property_Category',
        'Property_Type',
        'Price_Min',
        'Price_Max',
        'Area_Min',
        'Area_Max',
        'Bath_Max',
        'Bath_Min',
        'Parking_Sapce',
        'Location',
        'Brokerage_Agency_Name',
        'Broker_Name',
        'street',
        'city_town',
        'postal_code',
        'state',
        'country',
        'description',
        'Average_Time_spend',
        'Visited_Date',
        'Visited_Time',
        
        
        

    ];

}
