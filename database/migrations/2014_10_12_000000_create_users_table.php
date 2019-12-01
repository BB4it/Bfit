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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->tinyInteger('type');
            $table->integer('country_id');
            $table->integer('city_id');
            $table->tinyInteger('active')->default(false);

            $table->text('description')->nullable();
            $table->integer('available')->default(true)->nullable();
            $table->string('specialization',225)->nullable();
            $table->string('image')->nullable();
            $table->string('api_token')->nullable();
            $table->double('wallet')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('confirmation_code')->nullable();
            $table->string('password');
            $table->rememberToken();
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
