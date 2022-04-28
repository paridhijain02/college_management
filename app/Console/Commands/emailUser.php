<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class emailUser extends Command
{
    protected $signature = 'email:user';
    protected $description = 'Command description';
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        echo "My cron is running..";
    }
}
