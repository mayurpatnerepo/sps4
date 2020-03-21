<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prop_customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('prop_Customer_name')->nullable();
            $table->string('prop_Last_name')->nullable();
            $table->string('prop_Mobile_Number')->nullable();
            $table->string('prop_Email_Id')->nullable();
            $table->string('prop_Requirement_Type')->nullable();
            $table->string('prop_Requirement_Category')->nullable();
            $table->string('prop_property_category')->nullable();
            $table->string('prop_property_type')->nullable();
            $table->string('prop_Price_Min')->nullable();
            $table->string('prop_Price_Max')->nullable();
            $table->string('prop_Area_Min')->nullable();
            $table->string('prop_Area_Max')->nullable();
            $table->string('prop_Bath_Max')->nullable();
            $table->string('prop_Bath_Min')->nullable();
            $table->string('prop_Location')->nullable();
            $table->string('prop_Intrested_Property')->nullable();
            $table->string('prop_description')->nullable();
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
        Schema::dropIfExists('prop_customers');
    }
}
