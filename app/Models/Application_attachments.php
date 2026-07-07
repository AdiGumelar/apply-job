<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Application_attachments extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'attachment_id'
    ];

    public function application()
    {
        return $this->belongsTo(Applications::class);
    }

    public function attachment()
    {
        return $this->belongsTo(Attachments::class);
    }
}
