<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('prop_property_owner_name')->nullable();
            $table->string('prop_property_code')->nullable();
            $table->string('prop_property_name')->nullable();
            $table->string('prop_property_category')->nullable();
            $table->string('prop_listing_type')->nullable();
            $table->string('prop_listing_category')->nullable();
            $table->string('prop_property_type')->nullable();
            $table->string('prop_area_sqft')->nullable();
            $table->string('prop_bedroom')->nullable();
            $table->string('prop_bathroom')->nullable();
            $table->string('prop_parking_space')->nullable();
            $table->string('prop_project_name')->nullable();
            $table->string('prop_floor')->nullable();
            $table->string('prop_property_status')->nullable();
            $table->string('prop_property_action')->nullable();
            $table->string('prop_property_image')->nullable();
            $table->string('prop_street')->nullable();
            $table->string('prop_city_town')->nullable();
            $table->string('prop_zip_code')->nullable();
            $table->string('prop_state')->nullable();
            $table->string('prop_country')->nullable();
            $table->string('prop_unit_price')->nullable();
            $table->string('prop_deposite_money')->nullable();
            $table->string('prop_Listing_Owner_Landloard_Company')->nullable();
            $table->string('prop_listing_landloard_contact')->nullable();
            $table->string('prop_new_owner_landloard_company')->nullable();
            $table->string('prop_new_owner_contact')->nullable();
            $table->string('prop_description_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property');
    }
}
