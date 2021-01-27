<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\Logger;
use App\Models\Mail;
use App\Models\MTAServer;
use App\Libraries\JETDelivery;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, JETCustomMailer $jetMailer)
    {
        $this->data = $data;
        $this->jetMailer = $jetMailer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Load Available MTA Server from Database

        // Deliver the email message using any MTA server

        // Update Email Status based on the value of $delivery

    }

    private function saveEmailToDatabase()
    {
        // Save Email Item To The Database
        return Mail::create([
            'fromName' => $this->data['fromName'],
            'fromEmail' => $this->data['fromEmail'],
            'toEmail' => $this->data['toEmail'],
            'subject' => $this->data['subject'],
            'message' => $this->data['message'],
            'status' => 1
        ]);
    }

    private function loadMTAServers()
    {
        // Get enabled MTA servers list
        $this->mtaServers = MTAServer::where('enabled', 1)->get();

        if(count($this->mtaServers) == 0){
            Logger::create([
                'category' => 'MTA',
                'subject' => 'WARNING: NO MTA Servers Available ',
                'message' => 'There must be at least one MTA server enabled to deliver emails'
            ]);

            // Throw an Exception to move this Job to failed JOBs,
            // So we can retry them later using php artisan queue:retry
            throw new \Exception("NO MTA Servers Available");
        }

        // Shuffle the collection because I don't like to start with the same server everytime
        // So, by using shuffle I am starting with a random server,
        // regardingless the order returend from the database
        $this->mtaServers = $this->mtaServers->shuffle();
    }

    private function getMTAServer()
    {
        // Get Available MTA Server
        // IMPORTANT: Consider using Load Balancing
    }

    private function deliverEmail()
    {
        // Send Email Message
    }

}
