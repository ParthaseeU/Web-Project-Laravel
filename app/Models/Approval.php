<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Approval extends Model
{
    protected $table = 'approvals';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['user_type'];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(Administrator::class, 'approved_by', 'id');
    }
}
