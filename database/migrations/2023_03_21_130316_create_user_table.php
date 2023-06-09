<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id('user_id');
            $table->bigInteger('emp_no')->nullable();
            $table->string('name', 45);
            $table->date('birth');
            $table->string('phone');
            $table->string('address', 255);
            $table->string('login_id', 45);
            $table->string('password', 255);
            $table->integer('user_type')->default(0);
            $table->integer('status')->default(0);
            $table->dateTime('join_date')->nullable();
            $table->bigInteger('department_id')->nullable();
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
        Schema::dropIfExists('user');
    }
}
