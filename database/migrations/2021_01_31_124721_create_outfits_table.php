<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutfitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outfits', function (Blueprint $table) {
            $table->id();
            $table->string('type',64);
            $table->string('color',64);
            $table->integer('size');
            $table->foreignId('master_id')->constrained();
            $table->longText('about');
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
        Schema::dropIfExists('outfits');
    }
}
