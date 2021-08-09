<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseClass extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'description', 'content', 'course_id'];

    protected $searchableFields = ['*'];

    protected $table = 'course_classes';

    public function courseClassTasks()
    {
        return $this->hasMany(CourseClassTask::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function allAssistances()
    {
        return $this->hasMany(Assistances::class);
    }

    public function classComments()
    {
        return $this->hasMany(ClassComment::class);
    }
}
