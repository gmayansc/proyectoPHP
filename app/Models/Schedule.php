<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['id_class','continuous_assessment', 'time_start', 'time_end', 'day'];
    protected $primaryKey = 'id_schedule';


}
