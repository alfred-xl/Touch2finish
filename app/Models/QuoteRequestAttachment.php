<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuoteRequestAttachment extends Model
{
    protected $fillable = ['original_name', 'stored_path', 'disk', 'mime_type', 'file_size'];
    public function quoteRequest(): BelongsTo { return $this->belongsTo(QuoteRequest::class); }
}
