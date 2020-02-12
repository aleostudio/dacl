<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_user', function (Blueprint $table)
        {
            $table->bigIncrements('id');

            $table->bigInteger('permission_id')->unsigned()->nullable()->index();
            $table->bigInteger('user_id'      )->unsigned()->nullable()->index();
            $table->boolean   ('granted'      )->default(true);

            $table->timestamps();
        });

        Schema::table('permission_user', function(Blueprint $table)
        {
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->foreign('user_id'      )->references('id')->on('users'      )->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('permission_user');
    }
}
