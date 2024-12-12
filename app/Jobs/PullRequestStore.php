<?php

namespace App\Jobs;

use App\Models\PullRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class PullRequestStore implements ShouldQueue
{
    use Queueable;


    public function __construct(public array $pullRequest)
    {

    }


    public function handle(): void
    {
        PullRequest::create(
            [
                'api_id' => $this->pullRequest['id'],
                'api_number' => $this->pullRequest['number'],
                'state' => $this->pullRequest['state'],
                'title' => $this->pullRequest['title'],
                'api_created_at' => $this->pullRequest['created_at'],
                'api_updated_at' => $this->pullRequest['updated_at'],
                'api_closed_at' => $this->pullRequest['closed_at'] ?? null,
                'api_merged_at' => $this->pullRequest['merged_at'] ?? null,
            ]
        );
    }
}