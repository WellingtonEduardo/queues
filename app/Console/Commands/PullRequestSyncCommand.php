<?php

namespace App\Console\Commands;

use App\Jobs\PullRequestSync;
use Illuminate\Console\Command;

class PullRequestSyncCommand extends Command
{
    protected $signature = 'app:pull-request-sync-command {repositoryFullName}';


    protected $description = 'Command description';


    public function handle()
    {
        $repositoryFullName = $this->argument('repositoryFullName');
        PullRequestSync::dispatch($repositoryFullName);
    }
}