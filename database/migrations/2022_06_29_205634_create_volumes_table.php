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
        Schema::create('volumes', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->integer('number');
            $table->string('name');
            // $table->boolean('isLocked')->default(0);
            //        $table->string('thumbnail_url');
            $table->foreignId('comic_id')->constrained('comics')->onUpdate('CASCADE')->onDelete('CASCADE');
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
        Schema::dropIfExists('volumes');
    }
};
