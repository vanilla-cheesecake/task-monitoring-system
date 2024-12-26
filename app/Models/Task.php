<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable = [
        'title',
        'description',
        'file',
        'user_id',
        'created_by',
        'status',
    ];

    public function task()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
