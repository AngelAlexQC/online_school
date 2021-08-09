<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'content', 'file', 'author_id'];

    protected $searchableFields = ['*'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function classComments()
    {
        return $this->hasMany(ClassComment::class);
    }

    public function admissionAtaches()
    {
        return $this->hasMany(AdmissionAtach::class, 'attach_id');
    }

    public function studentTaskAttaches()
    {
        return $this->hasMany(StudentTaskAttach::class, 'attach_id');
    }
}
