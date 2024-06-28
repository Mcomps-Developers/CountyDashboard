<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function folder()
    {
        return $this->belongsTo(Folder::class, 'folder_id');
    }
}
