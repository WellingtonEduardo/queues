<?php

namespace App\Services\GitHub;

use Illuminate\Support\Facades\Http;

class PullRequestService
{
    public function getPullRequestsAll(string $repositoryFullName, int $page): array
    {
        $url = "repos/{$repositoryFullName}/pulls?state=all&page={$page}";

        $pullRequests = (new Client())->http()->get($url);

        return $pullRequests->json();
    }

    public function getPullRequest(string $repositoryFullName, int $number): array
    {
        $url = "https://api.github.com/repos/{$repositoryFullName}/pulls/{$number}";

        $pullRequest = (new Client())->http()->get($url);


        return $pullRequest->json();
    }
}