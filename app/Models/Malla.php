<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Malla extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'year', 'career_id'];

    protected $searchableFields = ['*'];

    public function career()
    {
        return $this->belongsTo(Career::class);
    }

    public function levels()
    {
        return $this->hasMany(Level::class);
    }

    public function admissions()
    {
        return $this->hasMany(Admission::class);
    }
}
