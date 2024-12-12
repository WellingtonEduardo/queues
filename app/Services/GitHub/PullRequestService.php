<?php

namespace App\Services\GitHub;

use Illuminate\Support\Facades\Http;

class PullRequestService
{
    public function getPullRequestsAll(string $repositoryFullName, int $page): array
    {
        $url = "https://api.github.com/repos/{$repositoryFullName}/pulls?state=all&page={$page}";
        dump($url);
        $pullRequestsResponse = Http::withToken(config('services.github.personal_access_token'))->get($url);

        $pullRequests = $pullRequestsResponse->json();

        return $pullRequests;
    }

    public function getPullRequest(string $repositoryFullName, int $number): array
    {
        $url = "https://api.github.com/repos/{$repositoryFullName}/pulls/{$number}";
        dump($url);
        $pullRequestResponse = Http::withToken(config('services.github.personal_access_token'))->get($url);

        $pullRequest = $pullRequestResponse->json();

        return $pullRequest;
    }
}