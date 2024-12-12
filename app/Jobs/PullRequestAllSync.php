<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;

class PullRequestAllSync implements ShouldQueue
{
    use Queueable;

    public function __construct(public string $repositoryFullName, public int $page = 1)
    {

    }

    public function handle(): void
    {

        $url = "https://api.github.com/repos/{$this->repositoryFullName}/pulls?state=all&page={$this->page}";
        dump($url);
        $pullRequestsResponse = Http::withToken(config('services.github.personal_access_token'))->get($url);

        $pullRequests = $pullRequestsResponse->json();


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