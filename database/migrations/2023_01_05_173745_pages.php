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
        Schema::create('Pages', function (Blueprint $table) {
            $table->id();
            $table->string('title',355);
            $table->string('slug');
            $table->text('content');
            $table->string('image',1000);
            $table->integer('order');
            $table->integer('status')->default(0)->comment('0 - pasif, 1 - aktif');
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
        Schema::dropIfExists('Pages');
    }
};
