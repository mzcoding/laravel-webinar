<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Goal extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'name',
        'term_in_months',
    ];
}
