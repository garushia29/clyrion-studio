<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Import extends Model
{
    use LogsActivity;

    protected $fillable = [
        'model_type', 'file_path', 'file_name', 'status',
        'total_rows', 'processed_rows', 'failed_rows',
        'error_message', 'errors', 'user_id',
    ];

    protected $casts = [
        'errors' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
