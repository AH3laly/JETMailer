<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MTAServer;

class CreateMTA extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jetMailer:CreateMTA 
        {--host= : SMTP host name} 
        {--port= : SMTP port number}
        {--security= : SMTP security (none | tls | ssl)}
        {--username= : SMTP username}
        {--password= : SMTP password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create MTA server';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        MTAServer::create([
            'host' => $this->option('host'),
            'port' => $this->option('port'),
            'security' => $this->option('security'),
            'username' => $this->option('username'),
            'password' => $this->option('password'),
            'failures' => 0,
            'enabled' => 1
        ]);
        
        echo "MTA Created".PHP_EOL;
        return 0;
    }
}
