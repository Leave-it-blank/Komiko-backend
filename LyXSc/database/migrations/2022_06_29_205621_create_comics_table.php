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
        Schema::create('comics', function (Blueprint $table) {
            $table->uuid('uid')->unique();
            $table->bigIncrements('id')->unsigned()->startingValue(5000);
            $table->string('title');
            $table->string('titleSlug');
            $table->longText('description')->nullable();
            $table->string('url')->nullable();
            $table->string('thumbnailUrl')->nullable();
            $table->boolean('isHidden')->default(0);
            $table->boolean('isMature')->default(0);
            $table->string('released_at')->nullable();
            $table->string('uploadDate')->nullable();
            $table->boolean('isLocked')->default(0);
            $table->timestamps();
            $table->softDeletes();

            //foriegn key
            $table->foreignid('country_id')->nullable()->constrained('countries')->onUpdate('CASCADE')->nullOnDelete();;
            $table->foreignId('artist_id')->nullable()->constrained('artists')->onUpdate('CASCADE')->nullOnDelete();;
            $table->foreignId('author_id')->nullable()->constrained('authors')->onUpdate('CASCADE')->nullOnDelete();;
            $table->foreignId('publisher_id')->nullable()->constrained('publishers')->onUpdate('CASCADE')->nullOnDelete();;

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comics');
    }
};
