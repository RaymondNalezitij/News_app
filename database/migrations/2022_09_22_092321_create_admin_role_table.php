<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('admin_roles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('is_admin_at');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admin_roles');
    }
};
