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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('avatar')->nullable()->default('/images/profile/avatar.png');
            $table->string('cover')->nullable()->default('/images/profile/d_cover.jpg');

            $table->string('ip',50)->nullable();
            $table->string('browser')->nullable();
            $table->string('device')->nullable();
            $table->string('os')->nullable();
            $table->string('country')->nullable();


            $table->unsignedBigInteger('rank_id');
            $table->enum('signature_status',[0,2])->default(0);
            $table->enum('status',['active','archive'])->default('active');
            $table->string('verify_code');
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
        Schema::dropIfExists('users');
    }
};
