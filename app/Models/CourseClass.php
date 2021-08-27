<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseClass extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'description',
        'content',
        'course_id',
        'date_start',
        'date_end',
        'number',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'course_classes';

    protected $casts = [
        'date_start' => 'date',
        'date_end' => 'date',
    ];

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

    public function getNameAttribute()
    {
        return "Clase #" . $this->number;
    }

    public function getNumberAttribute()
    {
        $number = 1;
        $courseClasses = CourseClass::where('course_id', $this->course_id)
            ->orderBy('date_start', 'asc')
            ->get();
        // Get my position in the list
        foreach ($courseClasses as $courseClass) {
            if ($courseClass->id == $this->id) {
                break;
            }
            $number++;
        }
        return $number;
    }
    public function scopeOrdered($query)
    {
        return $query->orderBy('date_start', 'asc')->get();
    }
    public static function boot()
    {
        parent::boot();

        static::created(function (CourseClass $courseClass) {
            CourseClassTask::create([
                'course_class_id' => $courseClass->id,
                'name' => 'Inicio',
                'description' => '',
                'content' => '',
            ]);
        });
    }
}
