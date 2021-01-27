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
    public function __construct($data, JETDelivery $jetDelivery)
    {
        $this->data = $data;
        $this->jetDelivery = $jetDelivery;
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
        // If it's only single MTAServer, then no sense for load balancing
        if(count($this->mtaServers)==1){
            return $this->mtaServers->first();
        }
        
        // Proceed with balancing
        // I am using rounding queue for balancing by Popping the last element from the collection,
        // then prepend it the the colection again,
        // So, the next pop will return the next element and so on
        $mtaServer = $this->mtaServers->pop();
        $this->mtaServers->prepend($mtaServer);
        
        return $mtaServer;
    }

    private function sendEmail($emailMessage)
    {
        $mtsServersCount = count($this->mtaServers);
        $delivery = [];

        for($i=0; $i<$mtsServersCount; $i++)
        {
            // Get an MTAServer to deliver the email
            $mtaServer = $this->getMTAServer();
            
            $this->jetDelivery->setServerConfig($mtaServer->host, $mtaServer->username, $mtaServer->password, $mtaServer->port, $mtaServer->security);

            // Deliver the Email Message using JETDelivery custom Library
            $delivery = $this->jetDelivery->deliverEmail([
                'fromName'=>$emailMessage['fromName'],
                'fromEmail'=>$emailMessage['fromEmail'],
                'toEmail'=>$emailMessage['toEmail'],
                'isHTML'=>true,
                'subject'=>$emailMessage['subject'],
                'message'=>$emailMessage['message'],
            ]);

            if($delivery['status'] == 1){
                // Delivery was successful, so no need to continue the loop,
                
                // Log Successful Delivery
                Logger::create([
                    'subject' => 'Successful Delivery',
                    'message' => 'Message '.$emailMessage['id'].' Delivered Successfully by '.$mtaServer->host
                ]);

                break;
            }

            // It's Important to know which MTA Server is failing,
            // So, with any failure, increment The MTAServer failures value
            MTAServers::where('id', $mtaServer->id)->increment('failures');

            // Log Failed Delivery
            Logger::create([
                'subject' => 'Failed Delivery',
                'message' => 'Message '.$emailMessage['id'].' Delivery Failed by '.$mtaServer->host." ({$delivery['message']})"
            ]);

            // Continue the loop until the $delivery['status'] is true or the end on loop reached
        }

        return $delivery['status'];
    }

}
