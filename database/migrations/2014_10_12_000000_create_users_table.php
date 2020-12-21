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
            $table->string('member_id', 20)->nullable();
            $table->string('name', 100);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('callsign', 20)->nullable();
            $table->string('category', 20);
            $table->string('class_premium', 20)->nullable();
            $table->boolean('life_time')->default(0);
            $table->date('register')->nullable();
            $table->boolean('active')->default(1);
            $table->boolean('manager')->default(0);
            $table->integer('life_time')
                ->default(0);
            $table->rememberToken();
            $table->string('no_hp', 20)->nullable();
            $table->text('alamat')->nullable();
            $table->string('foto', 200)->nullable();
            $table->integer('role'); // 0 adalah admin 1 adalah member
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
