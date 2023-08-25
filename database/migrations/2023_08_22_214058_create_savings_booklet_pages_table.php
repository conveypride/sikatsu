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
        Schema::create('savings_booklet_pages', function (Blueprint $table) {
            $table->id();
            $table->text('bookletId');
            $table->text('customerid');
            $table->text('pagenum');
            $table->text('isfull')->nullable();
            $table->text('haswithdrawn')->nullable();
            $table->text('totaldeposit')->nullable();
            $table->text('balance')->nullable();
            $table->text('profit')->nullable();
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
        Schema::dropIfExists('savings_booklet_pages');
    }
};
