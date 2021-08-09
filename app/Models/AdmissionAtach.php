<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdmissionAtach extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['admission_id', 'file', 'name', 'description'];

    protected $searchableFields = ['*'];

    protected $table = 'admission_ataches';

    public function admission()
    {
        return $this->belongsTo(Admission::class);
    }
}
