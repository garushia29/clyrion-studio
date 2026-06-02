<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'message', 'read'];

    protected $casts = [
        'read' => 'boolean',
    ];

    public function scopeUnread(Builder $query): void
    {
        $query->where('read', false);
    }
}
