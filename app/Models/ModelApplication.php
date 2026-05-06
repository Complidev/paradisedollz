<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelApplication extends Model
{
    public const STATUS_PENDING = 'pending';

    public const STATUS_APPROVED = 'approved';

    public const STATUS_REJECTED = 'rejected';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'experience_level',
        'social_handle',
        'age_confirmed',
    ];

    protected function casts(): array
    {
        return [
            'reviewed_at' => 'datetime',
            'age_confirmed' => 'boolean',
        ];
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
