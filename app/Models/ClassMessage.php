<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ClassMessage extends Model
{
    protected $table = 'class_message';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['date_sent', 'message'];
    public function classes(): BelongsTo
    {
        return $this->belongsTo(Classes::class, 'class_id', 'id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
