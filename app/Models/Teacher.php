<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Teacher extends Model
{
    protected $table = 'teachers';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['user_id', 'date_joined'];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subjects_taught', 'subjects_code');
    }
}
