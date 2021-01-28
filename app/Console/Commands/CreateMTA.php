<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

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
        // Validate Inputs
        $validator = Validator::make($this->options(), [
            'host' => 'required|max:255',
            'port' => 'required|max:4',
            'security' => 'required|max:4',
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) { 
            array_map(function($error){
                $this->error($error);
            }, $validator->errors()->all());
            return 1;
        }

        MTAServer::create([
            'host' => $this->option('host'),
            'port' => $this->option('port'),
            'security' => $this->option('security'),
            'username' => $this->option('username'),
            'password' => $this->option('password'),
            'failures' => 0,
            'enabled' => 1
        ]);
        
        $this->info("MTA server created.");
        return 0;
    }
}
