<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Assistances extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'student_id', 'course_class_id'];

    protected $searchableFields = ['*'];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function courseClass()
    {
        return $this->belongsTo(CourseClass::class);
    }
}
