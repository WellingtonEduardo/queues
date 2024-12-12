<?php

namespace App\Jobs;

use App\Models\PullRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;

class PullRequestSync implements ShouldQueue
{
    use Queueable;


    public function __construct(public string $repositoryFullName, public int $number)
    {

    }


    public function handle(): void
    {

        $url = "https://api.github.com/repos/{$this->repositoryFullName}/pulls/{$this->number}";
        dump($url);
        $pullRequestResponse = Http::withToken(config('services.github.personal_access_token'))->get($url);

        $pullRequest = $pullRequestResponse->json();
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