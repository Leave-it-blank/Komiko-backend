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
        Schema::create('chapters', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->integer('number')->unsigned();
            $table->string('name')->nullable();
            $table->boolean('isLocked')->default(0);
            $table->string('Url')->nullable();
            $table->foreignId('volume_id')->constrained('volumes')->onUpdate('CASCADE')->onDelete('CASCADE');;
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
        Schema::dropIfExists('chapters');
    }
};
