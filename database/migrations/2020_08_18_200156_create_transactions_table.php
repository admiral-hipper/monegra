<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->comment('ID типа');
            $table->foreignId('user_id')->comment('ID пользователя');
            $table->foreignId('currency_id')->comment('ID типа');
            $table->decimal('balance_token_amount', 15, 8)->default(0)->comment('Изменение баланса на основном счету в токенах');
            $table->decimal('balance_token_deposit_amount', 15, 8)->default(0)->comment('Изменение баланса на депозитном счету в токенах');
            $table->tinyInteger('balance_coin_amount')->default(0)->comment('Изменение баланса золотых монет');
            $table->decimal('amount', 15, 8)->default(0)->comment('Сумма в валюте транзакции');
            $table->decimal('amount_usd', 15, 8)->default(0)->comment('Сумма в USD');
            $table->decimal('rate_xau', 15, 8)->default(0)->comment('Текущий курс XAU/USD');
            $table->decimal('rate_token', 15, 8)->default(0)->comment('Текущий курс TOKEN/XAU');
            $table->enum('status', \App\Transaction::ALL_STATUSES)->default(\App\Transaction::STATUS_NEW)->comment('Статус');
            $table->string('comment')->nullable()->comment('Комментарий транзакции');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('type_id')->references('id')->on('transaction_types')->cascadeOnDelete();
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
