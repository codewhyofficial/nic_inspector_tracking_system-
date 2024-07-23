<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasswordResetsTable extends Migration
{
    public function up()
    {
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('user_id')->nullable();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
            $table->primary(['user_id', 'token']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('password_resets');
    }
}
