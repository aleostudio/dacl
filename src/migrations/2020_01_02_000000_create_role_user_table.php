<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table)
        {
            $table->bigIncrements('id');

            $table->bigInteger('role_id')->unsigned()->nullable()->index();
            $table->bigInteger('user_id')->unsigned()->nullable()->index();
            $table->boolean   ('granted')->default(true);

            $table->timestamps();
        });

        Schema::table('role_user', function(Blueprint $table)
        {
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('role_user');
    }
}
