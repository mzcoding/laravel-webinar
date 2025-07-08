<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Network extends Model
{
    protected $table = 'networks';

    protected $fillable = [
        'user_id',
        'network_type',
        'network_id',
        'token',
        'refresh_token',
        'avatar',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
