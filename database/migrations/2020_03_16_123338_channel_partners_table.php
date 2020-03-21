<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChannelPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Channel_Partners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Channel_Partner_photo')->nullable();
            $table->string('Channel_Partner_Id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('cp_username')->nullable();
            $table->string('password')->nullable();
            $table->string('Channel_Partner_email')->nullable();
            $table->string('Channel_Partner_Contact')->nullable();
            $table->string('gender')->nullable();
            $table->string('Marital_status')->nullable();
            $table->string('Date_Of_Birth')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('Address')->nullable();
            $table->string('relative_name')->nullable();
            $table->string('relation')->nullable();
            $table->string('relative_contact')->nullable();
            $table->string('relative_address')->nullable();
            $table->string('is_active')->nullable();
            
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
        //
    }
}
