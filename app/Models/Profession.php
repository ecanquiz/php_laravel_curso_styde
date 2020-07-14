<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Profession extends Model
{
    //protected $table = 'my_professions';

    //public $timestamps = false;
    protected $fillable = ['title'];

    public function users() //profession + _id
    {
       return $this->hasMany(User::class);
    }


}
