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

    protected $appends = ['student_tasks'];

    public static function boot()
    {
        parent::boot();

        static::created(function (Enrollment $enrollment) {
            $course = $enrollment->course;
            $course->courseClasses->each(function ($courseClass) use ($enrollment) {
                $courseClass->courseClassTasks->each(function ($courseClassTask) use ($enrollment) {
                    StudentTask::firstOrCreate([
                        'student_id' => $enrollment->student_id,
                        'task_id' => $courseClassTask->id,
                        'name' => $courseClassTask->name,
                    ]);
                });
            });
        });
    }

    public function getNameAttribute()
    {
        return $this->student->name;
    }

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

    public function getStudentTasksAttribute()
    {
        return StudentTask::where('student_id', $this->student_id)->get();
    }
}
