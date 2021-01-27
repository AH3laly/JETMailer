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
    }

    private function loadMTAServers()
    {
        // Load MTA Servers List
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
