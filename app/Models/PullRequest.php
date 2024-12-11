<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PullRequest extends Model
{
    protected $fillable = [
        'api_id',
        'api_number',
        'state',
        'title',
        'api_created_at',
        'api_updated_at',
        'api_closed_at',
        'api_merged_at',
    ];
}