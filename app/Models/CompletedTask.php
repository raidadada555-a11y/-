<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompletedTask extends Model
{
    protected $table = 'completed_tasks';

    protected $fillable = [
        'user_id',
        'name',
        'period',
        'detail',
        'priority',
    ];
}
