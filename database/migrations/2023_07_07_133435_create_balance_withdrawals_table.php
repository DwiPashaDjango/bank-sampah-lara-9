<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalanceWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_withdrawals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id');
            $table->foreignId('saldo_id');
            $table->string('kode_withdrawn');
            $table->decimal('amount_withdrawn');
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
        Schema::dropIfExists('balance_withdrawals');
    }
}
