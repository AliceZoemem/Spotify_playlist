<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaylistUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlist_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_user');
            $table->string('uri');
            $table->string('email');
            $table->string('country');
            $table->string('refresh_token',300);
            $table->string('auth_token',300);
            $table->boolean('injected')->default(False);
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
        Schema::dropIfExists('playlist_users');
    }
}
