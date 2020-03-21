<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('proj_project_name')->nullable();
           
            $table->string('proj_owner_name')->nullable();
            $table->string('proj_address')->nullable();
            $table->string('proj_phone_number')->nullable();
            $table->string('proj_email_id')->nullable();
            $table->string('proj_website')->nullable();
            $table->string('proj_developer_name')->nullable();
            $table->string('proj_project_code')->nullable();
         
            $table->string('proj_street')->nullable();
            $table->string('proj_city_town')->nullable();
            $table->string('proj_zip_code')->nullable();
            $table->string('proj_state')->nullable();
            $table->string('proj_country')->nullable();
           
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
        Schema::dropIfExists('projects');
    }
}
