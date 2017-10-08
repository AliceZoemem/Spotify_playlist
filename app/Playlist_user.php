<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist_user extends Model
{
    protected $table='playlist_users';
    protected $fillable= ['id_user','uri','email', 'country'];

}
