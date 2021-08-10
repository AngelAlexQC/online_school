<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'matter_id', 'period_id', 'teacher_id'];
    protected $appends = ['parallel_name'];

    protected $searchableFields = ['*'];

    public function matter()
    {
        return $this->belongsTo(Matter::class);
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    public function courseClasses()
    {
        return $this->hasMany(CourseClass::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function getParallelNameAttribute()
    {
        $parallel = 'A';
        $existents = Course::where(
            'period_id',
            $this->period_id
        )->where(
            'matter_id',
            $this->matter_id
        )->get();
        $alphabeth = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for ($i = 0; $i < count($existents); $i++) {
            $parallel = $alphabeth[$i];
        }
        return $this->matter->name . " - " . $this->matter->level->number . $parallel;
    }
    public function getNameAttribute()
    {
        return $this->getParallelNameAttribute();
    }
}
