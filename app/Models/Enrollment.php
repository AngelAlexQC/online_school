<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enrollment extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'student_id', 'course_id'];

    protected $searchableFields = ['*'];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function allAssistances()
    {
        return $this->hasMany(Assistances::class, 'student_id');
    }
}
