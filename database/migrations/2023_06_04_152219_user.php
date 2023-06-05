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
        Schema::create('users', function (Blueprint $table){
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('telegram');
            $table->string('phone');
            $table->timestamps();
        });

        Schema::create('groups', function (Blueprint $table){
            $table->increments('id');
            $table->integer('teacher_id');
            $table->string('group_name');
            $table->integer('level_id');
            $table->integer('id_type');
        });

        Schema::create('teachers',function (Blueprint $table){
            $table->increments('id');
            $table->string('initials');
            $table->string('telegram');
            $table->string('phone');
        });

        Schema::create('groups_list',function (Blueprint $table){
            $table->integer('user_id');
            $table->integer('group_id');
        });

        Schema::create('group_type',function (Blueprint $table){
            $table->integer('id');
            $table->string('name');
        });

        Schema::create('lang_level',function (Blueprint $table){
            $table->integer('id');
            $table->string('name');
        });

        Schema::create('allschedules', function (Blueprint $table) {
            $table->string('day');
            $table->time('time');
            $table->integer('group_id');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('groups');
        Schema::dropIfExists('teachers');
        Schema::dropIfExists('groups_list');
        Schema::dropIfExists('group_type');
        Schema::dropIfExists('lang_level');
        Schema::dropIfExists('allschedules');
    }
};
