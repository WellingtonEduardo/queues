<?php

namespace App\Services\GitHub\Jobs;

use App\Services\GitHub\PullRequestService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class PullRequestAllSync implements ShouldQueue
{
    use Queueable;

    public function __construct(public string $repositoryFullName, public int $page = 1)
    {
    }

    public function handle(): void
    {

        $pullRequests = (new PullRequestService())->getPullRequestsAll($this->repositoryFullName, $this->page);

        if (empty($pullRequests)) {
            return;
        }

        foreach ($pullRequests as $pullRequest) {
            PullRequestSync::dispatch($this->repositoryFullName, $pullRequest['number']);
        }
        $nextPage = $this->page + 1;
        PullRequestAllSync::dispatch($this->repositoryFullName, $nextPage);

    }
}