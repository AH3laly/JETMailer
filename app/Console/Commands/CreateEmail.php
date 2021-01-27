<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jetMailer:CreateEmail
        {--fromName= : From Name} 
        {--fromEmail= : From Email}
        {--toEmail= : To Email}
        {--subject= : Email Subject}
        {--message= : Email Message}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Schedule new email for delivery';

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
        $job = (new \App\Jobs\SendMailJob([
            'fromName'=>$this->option('fromName'), 
            'fromEmail'=>$this->option('fromEmail'),
            'toEmail'=>$this->option('toEmail'),
            'subject'=>$this->option('subject'),
            'message'=>$this->option('message')
        ]));
        
        dispatch($job);
        
        return 0;
    }
}
