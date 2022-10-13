<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('nces_district_id')->unique();
            $table->string('state_district_id')->unique();
            $table->string('district_name');
            $table->string('county_name');
            $table->string('street_address');
            $table->string('city');
            $table->string('state');
            $table->unsignedInteger('zip');
            $table->unsignedInteger('teacher_count');
            $table->unsignedInteger('student_count');
            $table->float('student_teacher_ratio', 3, 3);
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
        Schema::dropIfExists('districts');
    }
};
