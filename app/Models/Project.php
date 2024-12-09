<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'image',
    ];

    /*protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => mb_strtoupper($value),
        );
    }*/
}
