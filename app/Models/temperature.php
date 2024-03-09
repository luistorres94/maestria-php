<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class temperature extends Model
{   
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'temperature',
        'date',
    ];

    protected $hidden = [
       'id'
    ];
}
