<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'id_class', 'id_student', 'mark'];
    protected $primaryKey = 'id_exam';
    
    public function classe()
    {
        return $this->belongsTo(Classe::class, 'id_class');
    }
    public function student()
    {
        return $this->belongsTo(Student::class, 'id_student');
    }
}
