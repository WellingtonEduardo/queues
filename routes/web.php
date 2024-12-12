<?php

use App\Jobs\PullRequestSync;
use App\Models\PullRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    return view('welcome');

});