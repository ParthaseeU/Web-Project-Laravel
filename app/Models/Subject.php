<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['subjects_code', 'subjects_name'];
}
