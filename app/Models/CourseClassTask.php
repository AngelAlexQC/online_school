<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseClassTask extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'course_class_id',
        'name',
        'content',
        'file',
        'score',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'course_class_tasks';

    public function courseClass()
    {
        return $this->belongsTo(CourseClass::class);
    }

    public function studentTasks()
    {
        return $this->hasMany(StudentTask::class, 'task_id');
    }
}