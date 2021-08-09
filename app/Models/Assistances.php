<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Assistances extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'course_class_id', 'student_id'];

    protected $searchableFields = ['*'];

    public function courseClass()
    {
        return $this->belongsTo(CourseClass::class);
    }

    public function student()
    {
        return $this->belongsTo(Enrollment::class, 'student_id');
    }
}
