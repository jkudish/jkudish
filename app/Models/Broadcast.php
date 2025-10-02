<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Broadcast extends Model
{
    protected $fillable = [
        'bento_id',
        'issue_number',
        'name',
        'subject',
        'html_content',
        'share_url',
        'sent_at',
        'stats',
    ];

    protected function casts(): array
    {
        return [
            'sent_at' => 'datetime',
            'stats' => 'array',
        ];
    }

    public function scopeSent(Builder $query): Builder
    {
        return $query->whereNotNull('sent_at');
    }

    public function getRouteKeyName(): string
    {
        return 'issue_number';
    }
}
