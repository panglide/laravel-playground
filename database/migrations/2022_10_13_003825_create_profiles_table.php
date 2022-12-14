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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('teacher_id');
            $table->unsignedTinyInteger('grade_id');
            $table->unsignedTinyInteger('subject_id');
            $table->unsignedInteger('school_id');
            $table->unsignedInteger('coach_id');
            $table->text('pd_notes')->nullable();
            $table->string('avatar_url')->nullable();
            $table->date('last_touch')->nullable();
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
        Schema::dropIfExists('profiles');
    }
};
