<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->comment('ID пользователя');
            $table->unsignedBigInteger('ref_parent_id')->nullable()->comment('ID пользователя который пригласил');
            $table->char('ref_code', 8)->unique()->comment('Уникальный реферальный код');
            $table->char('name', 128)->comment('Имя');
            $table->char('surname', 128)->comment('Фамилия');
            $table->char('email', 128)->unique()->comment('Email');
            $table->timestamp('email_verified_at')->nullable()->comment('Дата подтверждения почты');
            $table->char('phone', 128)->nullable()->comment('Телефон');
            $table->string('password')->comment('Пароль');
            $table->decimal('balance_token', 15, 8)->default(0)->comment('Баланс в TOKEN');
            $table->decimal('balance_token_deposit', 15, 8)->default(0)->comment('Баланс в TOKEN, который получает накопления (депозит)');
            $table->tinyInteger('balance_coin', false, true)->default(0)->comment('Баланс золотых монет');
            $table->tinyInteger('rank', false, true)->default(0)->comment('Ранг пользователя');
            $table->char('locale', 2)->default(config('app.locale'))->comment('Язык пользователя');
            $table->boolean('is_admin')->default(0)->comment('Флаг админа');
            $table->unsignedBigInteger('lft')->default(0);
            $table->unsignedBigInteger('rgt')->default(0);
            $table->rememberToken();
            $table->timestamps();

            $table->index(['lft', 'rgt', 'ref_parent_id']);

            $table->foreign('ref_parent_id')->references('id')->on('users')->nullOnDelete()->cascadeOnUpdate();
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
            $table->dropForeign(['ref_parent_id']);
        });

        Schema::dropIfExists('users');
    }
}
