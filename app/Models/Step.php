<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Step extends Model
{
    use HasFactory;

    protected $fillable = [
        'goal_id',
        'name',
        'started_at',
        'finished_at',
    ];

    protected $casts = [
        'started_at' => 'immutable_datetime',
        'finished_at' => 'immutable_datetime',
    ];

    public function goal(): BelongsTo
    {
        return $this->belongsTo(Goal::class);
    }
}
