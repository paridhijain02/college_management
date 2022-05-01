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
        $session=session('username');
        if(isset($session)){
            echo "Someone is logged in, ";
        }
        else{
            echo "There is no one, ";
        }
        if (44%3==0){
            echo "Divided by 3";
        }
        else{
            echo "Not divisible by 3";
        }
    }
}
