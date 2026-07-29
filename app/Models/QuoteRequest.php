<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuoteRequest extends Model
{
    protected $fillable = ['reference', 'name', 'email', 'phone', 'postcode', 'service_slug', 'service_title',
        'preferred_date', 'preferred_contact_method', 'message', 'service_details', 'status', 'notification_status',
        'notification_error', 'consent_at', 'ip_address', 'user_agent'];
    protected function casts(): array { return ['preferred_date' => 'date', 'service_details' => 'array', 'consent_at' => 'datetime']; }
    public function attachments(): HasMany { return $this->hasMany(QuoteRequestAttachment::class); }
}
