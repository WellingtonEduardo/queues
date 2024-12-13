<?php

namespace App\Services\GitHub;

use Illuminate\Support\Facades\Http;

class PullRequestReviewersRequestedService
{
    public function getAll(string $repositoryFullName, int $pullRequestNumber): array
    {
        $url = "repos/{$repositoryFullName}/pulls/{$pullRequestNumber}/requested_reviewers";

        $pullRequests = (new Client())->http()->get($url);

        return $pullRequests->json();
    }
}