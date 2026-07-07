<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Email_logs extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'status',
        'message'
    ];

    public function application()
    {
        return $this->belongsTo(Applications::class);
    }
}
