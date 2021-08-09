<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentTaskAttach extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['student_task_id', 'attach_id'];

    protected $searchableFields = ['*'];

    protected $table = 'student_task_attaches';

    public function studentTask()
    {
        return $this->belongsTo(StudentTask::class);
    }

    public function attach()
    {
        return $this->belongsTo(Comment::class, 'attach_id');
    }
}
