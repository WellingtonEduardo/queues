<?php

namespace App\Console\Commands;

use App\Jobs\PullRequestAllSync;
use Illuminate\Console\Command;

class PullRequestSyncCommand extends Command
{
    protected $signature = 'app:pull-request-all-sync-command {repositoryFullName}';


    protected $description = 'Command description';


    public function handle()
    {
        $repositoryFullName = $this->argument('repositoryFullName');
        PullRequestAllSync::dispatch($repositoryFullName);
    }
}