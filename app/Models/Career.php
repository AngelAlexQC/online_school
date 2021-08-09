<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Career extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'description', 'school_id'];

    protected $searchableFields = ['*'];

    public function mallas()
    {
        return $this->hasMany(Malla::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
