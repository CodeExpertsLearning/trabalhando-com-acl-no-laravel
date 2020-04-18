<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourceRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_role', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
	        $table->unsignedBigInteger('resource_id');

	        $table->foreign('role_id')->references('id')->on('roles');
	        $table->foreign('resource_id')->references('id')->on('resources');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resource_role');
    }
}
