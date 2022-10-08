<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    // return is favouriste as boolean from database
    protected $casts =["is_favourite"=>"boolean"];
    protected $fillable = ["name","tel","is_favourite"];
}
