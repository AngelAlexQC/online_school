<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassComment extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'comment_id', 'course_class_id'];

    protected $searchableFields = ['*'];

    protected $table = 'class_comments';

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function courseClass()
    {
        return $this->belongsTo(CourseClass::class);
    }
}
