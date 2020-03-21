<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class enquiry extends Model
{
    protected $fillable =
     [
    'Select_Contact_person',
    'organization_name',    
    'EnquiryDataSource_Name',
    'ReferredBy_Name',
    'EnquiryType_Name',
    'nature',
    'Expected_closed_Date',
    'Description_Note',
    
];
}
