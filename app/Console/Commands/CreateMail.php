<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

use App\Libraries\JETDelivery;

class CreateMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jetMailer:CreateMail
        {--fromName= : From Name} 
        {--fromEmail= : From Email}
        {--toEmail= : To Email}
        {--subject= : Email Subject}
        {--body= : Email Body}
        {--format= : Email format (text | html | markdown)}';

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
    public function handle(JETDelivery $jetDelivery)
    {

        // Validate Inputs
        $validator = Validator::make($this->options(), [
            'fromName' => 'required|max:50',
            'fromEmail' => 'required|max:255',
            'toEmail' => 'required',
            'subject' => 'required|max:100',
            'body' => 'required',
            'format' => 'required'
        ]);

        if ($validator->fails()) { 
            array_map(function($error){
                $this->error($error);
            }, $validator->errors()->all());
            return 1;
        }

        $job = (new \App\Jobs\SendMailJob([
            'fromName'=>$this->option('fromName'), 
            'fromEmail'=>$this->option('fromEmail'),
            'toEmail'=>$this->option('toEmail'),
            'subject'=>$this->option('subject'),
            'body'=>$this->option('body'),
            'format'=>$this->option('format')
        ], $jetDelivery));
        
        dispatch($job);

        $this->info("Message scheduled for delivery");
        
        return 0;
    }
}
