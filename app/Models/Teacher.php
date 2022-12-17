<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = ['email', 'name', 'surname', 'telephone', 'nif' , 'pass'];
    protected $hidden = [
        'pass',
    ];
}
