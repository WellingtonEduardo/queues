<?php

namespace App\Services\GitHub;

use Illuminate\Support\Facades\Http;

class PullRequestService
{
    public function getPullRequestsAll(string $repositoryFullName, int $page): array
    {
        $queryString = http_build_query([
            'state' => 'all',
            'page' => $page,
        ], arg_separator: '&', encoding_type: PHP_QUERY_RFC3986);

        $url = "repos/{$repositoryFullName}/pulls?{$queryString}";
        $pullRequests = (new Client())->http()->get($url);
        return $pullRequests->json();
    }

    public function getPullRequest(string $repositoryFullName, int $number): array
    {
        $url = "repos/{$repositoryFullName}/pulls/{$number}";

        $pullRequest = (new Client())->http()->get($url);


        return $pullRequest->json();
    }
}