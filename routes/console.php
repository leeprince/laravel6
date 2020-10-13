<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
    Log::debug('执行 inspire 命令。date:'.date('Y-m-d H:i:s'));
})->describe('Prince - Display an inspiring quote');
