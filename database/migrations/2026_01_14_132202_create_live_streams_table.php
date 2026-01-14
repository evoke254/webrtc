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
        Schema::create('live_streams', function (Blueprint $table) {
            $table->id();
            $table->uuid('uid')->nullable()->unique();
            $table->string('title')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->text('description')->nullable();
            $table->boolean('live')->default(false);
            $table->string('session_id');
            $table->string('stream_id');
            $table->bigInteger('room_id')->nullable();
            $table->string('token')->nullable();
            $table->string('live_url')->nullable();
            $table->string('poster')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live_streams');
    }
};
