<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comparaison extends Model
{
    protected $fillable = ['title', 'order', 'before_image', 'after_image'];
}
