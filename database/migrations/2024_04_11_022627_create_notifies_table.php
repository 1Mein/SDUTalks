<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('notifies', function (Blueprint $table) {
            // Define your table schema here
            $table->id();
            $table->string('type');
            $table->unsignedBigInteger('from_user')->nullable();
            $table->unsignedBigInteger('on_post')->nullable();
            $table->unsignedBigInteger('on_comment')->nullable();
            $table->text('text');
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('from_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('on_post')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('on_comment')->references('id')->on('comments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('notifies');
    }
};
