<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPinVerificationToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('account_pin')->nullable();
            $table->timestamp('pin_verified_at')->nullable();
        });

        Schema::table('accounts', function (Blueprint $table) {
            $table->string('account_pin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('account_pin');
            $table->dropColumn('pin_verified_at');
        });

        Schema::table('accounts', function (Blueprint $table) {
            $table->dropColumn('account_pin');
        });
    }
}
