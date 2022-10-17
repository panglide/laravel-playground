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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nces_school_id')->unique();
            $table->string('state_school_id')->unique();
            $table->unsignedBigInteger('nces_district_id');
            $table->string('state_district_id');
            $table->string('school_name');
            $table->string('district_name');
            $table->string('street_address');
            $table->string('city');
            $table->string('state');
            $table->unsignedInteger('zip');
            $table->boolean('title_1_school');
            $table->unsignedInteger('teacher_count')->nullable();
            $table->unsignedInteger('student_count')->nullable();
            $table->float('teacher_student_ratio')->nullable();
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
        Schema::dropIfExists('schools');
    }
};
