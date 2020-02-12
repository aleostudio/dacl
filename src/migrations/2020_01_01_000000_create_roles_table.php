<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table)
        {
            $table->bigIncrements('id');

            $table->string    ('name'       )->index();
            $table->string    ('slug'       )->unique()->index();
            $table->string    ('description')->nullable();
            $table->bigInteger('parent_id'  )->unsigned()->nullable()->index();

            $table->timestamps();
        });

        Schema::table('roles', function(Blueprint $table)
        {
            $table->foreign('parent_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('roles');
    }
}
