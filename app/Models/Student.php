<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['username', 'pass', 'email', 'name', 'surname', 'telephone', 'nif'];
    protected $primaryKey = 'id_student';

}
