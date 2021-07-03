<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsSpecialtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors_specialties', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->rowFormat = 'DYNAMIC';

            $table->id();
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('specialty_id');

            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->foreign('specialty_id')->references('id')->on('specialties');
            
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
        Schema::dropIfExists('doctors_specialties');
    }
}
