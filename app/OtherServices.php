<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherServices extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'short_description', 'cylinder','price'];
}
