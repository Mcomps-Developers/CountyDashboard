<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcounty extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function wards()
    {
        return $this->hasMany(Ward::class, 'subcounty_id');
    }
}
