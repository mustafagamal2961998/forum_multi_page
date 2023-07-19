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
        Schema::create('ranks', function (Blueprint $table) {
            $table->id();
            $table->string('rank_name')->default('عضو جديد');
//            $table->string('rank_level')->default('0');
            $table->string('rank_icon')->default('/images/d_icons/new_member.svg');
            $table->string('rank_bg_color')->nullable()->default('#3c87c5');
            $table->string('rank_text_color')->nullable()->default('#ffffff');
            $table->string('rank_font_weight')->nullable()->default('bold');
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
        Schema::dropIfExists('ranks');
    }
};
