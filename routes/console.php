<?php

use Illuminate\Foundation\Inspiring;

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

Artisan::command('install',function(){
    $this->info("Installing the JsonToApi system..");
    $this->call("migrate:refresh");
    $this->call("db:seed");
    $this->call("ide-helper:models");
})->describe("Install the JsonToApi system");

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');
