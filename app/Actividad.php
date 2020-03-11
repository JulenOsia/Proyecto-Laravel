<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Actividad extends Model
{
    //
    protected $table='actividades';
}

class Post extends Model{

    use Searchable;

    public function searchableAs()
    {
        return 'posts_index';
    }




}
