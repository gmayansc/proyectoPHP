<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_course',
        'id_student',
        'status',
    ];

    protected $table = 'enrollment';
    protected $primaryKey = 'id_enrollment';


    public function course()
    {
        return $this->belongsTo(Course::class, 'id_course');
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'id_classe');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'id_student');
    }
    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'id_schedule');
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'id_teacher');
    }
}
