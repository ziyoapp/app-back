<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();

            $table->char('user_lang', 10)->default('ru');

            $table->string('first_name');
            $table->string('last_name');
            $table->string('patronymic')->nullable();
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->string('phone', 30)->nullable();

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->boolean('events_push_enabled')->default(1);
            $table->boolean('products_push_enabled')->default(1);
            $table->boolean('news_push_enabled')->default(1);

            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
