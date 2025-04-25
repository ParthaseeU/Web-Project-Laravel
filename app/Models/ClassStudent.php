<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ClassStudent extends Model
{
    protected $table = 'class_students';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public function class(): BelongsTo
    {
        return $this->belongsTo(Classes::class, 'class_id', 'id');
    }
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'students_id', 'id');
    }
}
