<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTabl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('program_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('name',255);
            $table->integer('age');
            $table->tinyInteger('gender');
            $table->double('weight');
            $table->double('tall');
            $table->tinyInteger('health_diseases');
            $table->bigInteger('subscription_goals_id')->unsigned();
            $table->bigInteger('sports_levels_id')->unsigned();
            $table->bigInteger('sports_types_id')->unsigned();
            $table->bigInteger('fats_area_id')->unsigned();
            $table->integer('meals_number')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('food_allergy');
            $table->tinyInteger('medicine_status');
            $table->string('medicine_name',225)->nullable();
            $table->double('right_arm');
            $table->double('left_arm');
            $table->double('chest');
            $table->double('buttocks');
            $table->double('belly');
            $table->double('right_thigh');
            $table->double('left_thigh');




            $table->foreign('program_id')
                ->references('id')->on('programs')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('subscription_goals_id')
                ->references('id')->on('sports')
                ->onDelete('cascade');
            $table->foreign('sports_levels_id')
                ->references('id')->on('sports')
                ->onDelete('cascade');
            $table->foreign('sports_types_id')
                ->references('id')->on('sports')
                ->onDelete('cascade');
            $table->foreign('fats_area_id')
                ->references('id')->on('sports')
                ->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
}
