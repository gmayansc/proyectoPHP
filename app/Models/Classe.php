<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'color', 'id_course', 'id_schedule', 'id_teacher'];
    protected $table = 'classes';

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'id_teacher');
    }
    public function course()
    {
        return $this->belongsTo(Course::class, 'id_course');
    }
    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'id_schedule');
    }
}
