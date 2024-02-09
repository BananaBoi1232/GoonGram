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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id('userID');
            $table->string('email');
            $table->string('pass');
            $table->string('username');
            $table->string('accountType');
            $table->integer('private');
            $table->text('bio');
            $table->text('profilePicture');
            $table->integer('followerCount');
            $table->integer('followingCount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
