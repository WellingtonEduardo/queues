<?php

namespace App\Services\GitHub;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class Client
{
    private string $baseURI = 'https://api.github.com';

    public function http(): PendingRequest
    {

        return Http::withOptions([
            'base_uri' => $this->baseURI,
        ])
            ->withHeaders([
                'Accept' => 'application/vnd.github+json',
                'X-GitHub-Api-Version' => '2022-11-28',
            ])
            ->withToken(config('services.github.personal_access_token'));
    }
}
