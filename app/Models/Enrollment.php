<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enrollment extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'student_id'];

    protected $searchableFields = ['*'];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
