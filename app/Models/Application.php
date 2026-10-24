<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\ApplicationStatus;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'company',
        'role',
        'status',
        'applied_date',
        'salary_range',
        'notes',
    ];

    protected function casts(): array 
    {
        return [
            'applied_date' => 'date',
            'status' => ApplicationStatus::class,
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
