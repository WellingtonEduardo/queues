<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Collaborator extends Model
{
    protected $fillable = [
        'api_id',
        'login',
    ];
    public function pullRequests(): BelongsToMany
    {
        return $this->belongsToMany(PullRequest::class);
    }
}