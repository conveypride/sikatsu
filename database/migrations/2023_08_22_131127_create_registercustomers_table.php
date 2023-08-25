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
        Schema::create('registercustomers', function (Blueprint $table) {
            $table->id();
            $table->text('newcustomer');
            $table->text('cardprice');
            $table->text('cardnum');
            $table->text('registrationdate');
            $table->text('initialdeposite');
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
        Schema::dropIfExists('registercustomers');
    }
};
