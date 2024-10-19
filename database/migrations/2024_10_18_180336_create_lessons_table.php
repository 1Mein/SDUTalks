<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('instructor_id');
            $table->foreign('instructor_id', 'instructor_id_fk')->references('id')->on('instructors');

            $table->string('course_code');
            $table->string('name');
            $table->string('name_kz');

            $table->string('group');
            $table->string('type');
            $table->string('type_kz');

            $table->string('cabinet');

            $table->string('day');
            $table->string('day_kz');
            $table->string('time');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
