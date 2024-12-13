<?php

namespace App\Services\GitHub\Jobs;

use App\Models\Collaborator;
use App\Models\PullRequest;
use App\Services\GitHub\PullRequestReviewersRequestedService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class PullRequestReviewersRequestedSync implements ShouldQueue
{
    use Queueable;

    public function __construct(public string $repositoryFullName, public int $pullRequestNumber)
    {
    }

    public function handle(): void
    {

        $response =  (new PullRequestReviewersRequestedService())->getAll($this->repositoryFullName, $this->pullRequestNumber);

        $collaborators = $response['users'];

        if (empty($collaborators)) {
            return;
        }
        foreach ($collaborators as $collaborator) {
            $collaborator =  Collaborator::query()->updateOrCreate([
                   'api_id' => $collaborator['id'],
                   'login' => $collaborator['login'],
               ]);
            $pr = PullRequest::query()->where('api_number', $this->pullRequestNumber)->first();
            $collaborator->pullRequests()->attach($pr);

        }
    }
}
