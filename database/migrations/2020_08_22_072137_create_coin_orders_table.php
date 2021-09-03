<?php

use App\CoinOrder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coin_orders', function (Blueprint $table) {
            $table->id()->comment('ID заявки');
            $table->foreignId('transaction_id')->comment('ID транзакции');
            $table->foreignId('user_id')->comment('ID пользователя');
            $table->char('full_name', 128)->comment('Имя получателя');
            $table->string('address', 256)->comment('Адрес');
            $table->string('phone', 128)->comment('Телефон');
            $table->tinyInteger('coin_amount')->comment('Количество монет');
            $table->timestamps();

            $table->foreign('transaction_id')
                ->references('id')
                ->on('transactions')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coin_orders');
    }
}
