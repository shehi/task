<?php

declare(strict_types=1);

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends \Illuminate\Contracts\Database\Eloquent\
 */
class Timetable extends Model
{
    use HasFactory;

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    protected $table = 'timetable';
}
