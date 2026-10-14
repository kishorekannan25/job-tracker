<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'company',
        'role',
        'status',
        'applied_date',
        'salary_range',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
