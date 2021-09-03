<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionContextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_contexts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->comment('ID транзакции');
            $table->text('data')->nullable()->comment('Контекст');

            $table->foreign('transaction_id')
                ->references('id')
                ->on('transactions')
                ->cascadeOnUpdate()
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
        Schema::dropIfExists('transaction_contexts');
    }
}
