<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Classes extends Model
{
    protected $table = 'classes';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['level', 'class_group'];
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'teachers_id', 'id');
    }
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subjects_code', 'subjects_code');
    }
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'class_students', 'class_id', 'students_id');
    }
    public function classMessages(): HasMany
    {
        return $this->hasMany(ClassMessage::class, 'class_id', 'id');
    }
}
