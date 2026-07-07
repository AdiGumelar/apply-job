<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Applications extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'template_id',
        'company_name',
        'job_position',
        'receiver_email',
        'email_subject',
        'email_body',
        'status',
        'sent_at'
    ];

    protected $casts = [
        'sent_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function template()
    {
        return $this->belongsTo(Templates::class);
    }

    public function attachments()
    {
        return $this->belongsToMany(
            Attachments::class,
            'application_attachments'
        );
    }

    public function logs()
    {
        return $this->hasMany(Email_logs::class);
    }
}
