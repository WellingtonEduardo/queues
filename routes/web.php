<?php

use App\Models\PullRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $pullRequests = Http::get('https://api.github.com/repos/laravel/laravel/pulls?state=all');

    foreach ($pullRequests->json() as $pullRequest) {
        PullRequest::create(
            [
                'api_id' => $pullRequest['id'],
                'api_number' => $pullRequest['number'],
                'state' => $pullRequest['state'],
                'title' => $pullRequest['title'],
                'api_created_at' => $pullRequest['created_at'],
                'api_updated_at' => $pullRequest['updated_at'],
                'api_closed_at' => $pullRequest['closed_at'] ?? null,
                'api_merged_at' => $pullRequest['merged_at'] ?? null,
            ]
        );

    }


});
