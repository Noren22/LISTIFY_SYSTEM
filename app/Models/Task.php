<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'is_completed', 'deadline', 'deadline_time'];

    protected $casts = [
        'is_completed' => 'boolean',
        'deadline' => 'date',
        'deadline_time' => 'string',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
