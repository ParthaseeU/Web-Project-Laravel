<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['level', 'class_group'];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function classes(): BelongsToMany
    {
        return $this->belongsToMany(Classes::class, 'class_students', 'student_id', 'class_id');
    }
}
