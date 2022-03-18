<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class spa extends Model
{
    use HasFactory;
    protected $table="cruds";
protected $fillable=['id','name','address','trending'];
}
