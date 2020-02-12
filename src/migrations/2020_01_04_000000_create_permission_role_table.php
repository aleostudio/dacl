<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_role', function (Blueprint $table)
        {
            $table->bigIncrements('id');

            $table->bigInteger('permission_id')->unsigned()->nullable()->index();
            $table->bigInteger('role_id'      )->unsigned()->nullable()->index();
            $table->boolean   ('granted'      )->default(true);

            $table->timestamps();
        });

        Schema::table('permission_role', function(Blueprint $table)
        {
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->foreign('role_id'      )->references('id')->on('users'      )->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('permission_role');
    }
}
