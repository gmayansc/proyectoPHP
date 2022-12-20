<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id',
        'student_id',
        'status',
        'id_enrollment',
    ];

    protected $table = 'enrollment';
    protected $primaryKey = 'id_enrollment';


    public function course()
    {
        return $this->belongsTo(Course::class, 'id_course');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'id_student');
    }
    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'id_schedule');
    }
}
