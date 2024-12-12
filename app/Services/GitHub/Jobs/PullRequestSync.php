<?php

namespace App\Services\GitHub\Jobs;

use App\Models\PullRequest;
use App\Services\GitHub\PullRequestService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class PullRequestSync implements ShouldQueue
{
    use Queueable;

    public function __construct(public string $repositoryFullName, public int $number) {}

    public function handle(): void
    {

        $pullRequest = (new PullRequestService)->getPullRequest($this->repositoryFullName, $this->number);

        PullRequest::create(
            [
                'api_id' => $pullRequest['id'],
                'api_number' => $pullRequest['number'],
                'state' => $pullRequest['state'],
                'title' => $pullRequest['title'],
                'commits_total' => $pullRequest['commits'],
                'api_created_at' => $pullRequest['created_at'],
                'api_updated_at' => $pullRequest['updated_at'],
                'api_closed_at' => $pullRequest['closed_at'] ?? null,
                'api_merged_at' => $pullRequest['merged_at'] ?? null,
            ]
        );
    }
}
