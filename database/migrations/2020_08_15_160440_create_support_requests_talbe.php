<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportRequestsTalbe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_requests', function (Blueprint $table) {
            $table->id();
            $table->char('name', 255)->nullable()->comment('Имя автора обращения');
            $table->char('email', 255)->comment('Почта автора обращения');
            $table->text('message')->comment('Сообщение автора обращения');
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
        Schema::dropIfExists('support_requests');
    }
}
