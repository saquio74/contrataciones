<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsroleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissionsrole', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('permission_id');
            $table->foreign('permission_id')->references('id')->on('permissions');
            $table->unsignedBigInteger('rol_id');
            $table->foreign('rol_id')->references('id')->on('roles');
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
        Schema::dropIfExists('permissionsrole');
    }
}
