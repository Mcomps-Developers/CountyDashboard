<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ward extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function subCounty()
    {
        return $this->belongsTo(Subcounty::class, 'subcounty_id');
    }
}
