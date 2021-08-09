<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class School extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'slug', 'address', 'phone', 'url'];

    protected $searchableFields = ['*'];

    public function careers()
    {
        return $this->hasMany(Career::class);
    }

    public function periods()
    {
        return $this->hasMany(Period::class);
    }
}
