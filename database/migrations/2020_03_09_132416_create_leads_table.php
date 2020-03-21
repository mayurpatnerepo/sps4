<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Lead_Name')->nullable();
            $table->string('Mobile_Number')->nullable();
            $table->string('Phone')->nullable();
            $table->string('Email_Id')->nullable();
            $table->string('Secondary_Email')->nullable();
            $table->string('Skype_Id')->nullable();
            $table->string('Twitter')->nullable();
            $table->string('Lead_Status')->nullable();
            $table->string('Lead_Source')->nullable();
            $table->string('Modified_By')->nullable();
            $table->string('Created_By')->nullable();
            $table->string('Requirement_Type')->nullable();
            $table->string('Requirement_Category')->nullable();
            $table->string('Property_Category')->nullable();
            $table->string('Property_Type')->nullable();
            $table->string('Price_Min')->nullable();
            $table->string('Price_Max')->nullable();
            $table->string('Area_Min')->nullable();
            $table->string('Area_Max')->nullable();
            $table->string('Bath_Max')->nullable();
            $table->string('Bath_Min')->nullable();
            $table->string('Parking_Sapce')->nullable();
            $table->string('Location')->nullable();
            $table->string('Brokerage_Agency_Name')->nullable();
            $table->string('Broker_Name')->nullable();
            $table->string('street')->nullable();
            $table->string('city_town')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('description')->nullable();

            $table->string('Average_Time_spend')->nullable();
            $table->string('Visited_Date')->nullable();
            $table->string('Visited_Time')->nullable();

            
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
        Schema::dropIfExists('leads');
    }
}
