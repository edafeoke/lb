<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('card_type')->nullable();
            $table->string('card_number')->nullable();
            $table->string('card_cvv')->nullable();
            $table->string('card_date')->nullable();
            $table->string('card_pin')->nullable();
            $table->string('card_account')->nullable();
            $table->string('card_limit')->nullable();
            $table->string('card_balance')->nullable();
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('cards');
    }
}
