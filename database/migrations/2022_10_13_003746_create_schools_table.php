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
            $table->unsignedInteger('nces_school_id')->unique();
            $table->string('state_school_id')->unique();
            $table->unsignedInteger('nces_district_id')->unique();
            $table->string('state_district_id')->unique();
            $table->string('school_name');
            $table->string('district_name');
            $table->string('street_address');
            $table->string('city');
            $table->string('state');
            $table->unsignedInteger('zip');
            $table->boolean('title_1_school');
            $table->unsignedInteger('teacher_count');
            $table->unsignedInteger('student_count');
            $table->float('teacher_student_ratio', 3, 3);
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
