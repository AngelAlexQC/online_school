<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentTask extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'student_id', 'task_id'];

    protected $searchableFields = ['*'];

    protected $table = 'student_tasks';

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function task()
    {
        return $this->belongsTo(CourseClassTask::class, 'task_id');
    }

    public function studentTaskAttaches()
    {
        return $this->hasMany(StudentTaskAttach::class);
    }
}
