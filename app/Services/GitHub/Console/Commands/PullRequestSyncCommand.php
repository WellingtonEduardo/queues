<?php

namespace App\Services\GitHub\Console\Commands;

use App\Services\GitHub\Jobs\PullRequestAllSync as JobsPullRequestAllSync;
use Illuminate\Console\Command;

class PullRequestSyncCommand extends Command
{
    protected $signature = 'github:pull-request-all-sync-command {repositoryFullName}';

    protected $description = 'Command description';

    public function handle()
    {
        $repositoryFullName = $this->argument('repositoryFullName');
        JobsPullRequestAllSync::dispatch($repositoryFullName);
    }
}