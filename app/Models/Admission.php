<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admission extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Searchable;

    protected $fillable = ['malla_id', 'status', 'requester_id'];

    protected $searchableFields = ['*'];

    public function malla()
    {
        return $this->belongsTo(Malla::class);
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    public function admissionAtaches()
    {
        return $this->hasMany(AdmissionAtach::class);
    }
}
