<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Level extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = ['malla_id', 'number', 'name'];

    protected $searchableFields = ['*'];

    public function malla()
    {
        return $this->belongsTo(Malla::class);
    }

    public function matters()
    {
        return $this->hasMany(Matter::class);
    }
}
