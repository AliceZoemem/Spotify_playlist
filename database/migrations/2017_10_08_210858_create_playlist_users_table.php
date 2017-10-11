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
            $table->text('refresh_token');
            $table->text('auth_token');
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
