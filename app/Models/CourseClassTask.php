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
        'description',
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

    public function getNameAttribute()
    {
        return "Tarea #" . $this->number . " de la Clase #" . $this->courseClass->number;
    }
    public function getNumberAttribute()
    {
        $number = 1;
        $courseClassTasks = CourseClassTask::where('course_class_id', $this->course_class_id)
            ->get();
        // Get my position in the list
        foreach ($courseClassTasks as $task) {
            if ($task->id == $this->id) {
                break;
            }
            $number++;
        }
        return $number;
    }

    public static function boot()
    {
        parent::boot();

        static::created(function (CourseClassTask $task) {
            foreach ($task->courseClass->course->enrollments as $enrollment) {
                StudentTask::firstOrCreate([
                    'student_id' => $enrollment->student_id,
                    'task_id' => $task->id,
                    'name' => $task->name,
                ]);
            }
        });
    }
}
