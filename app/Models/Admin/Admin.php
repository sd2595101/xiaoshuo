<?php
namespace App\Models\Admin;

//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Admin extends Model
{

    //
    protected $connection = 'mongodb';
    protected $fillable = [
        "email",
    ];

}
