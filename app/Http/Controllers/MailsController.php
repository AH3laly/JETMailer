<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Mail;
use App\Models\MTAServer;
use App\Libraries\JETDelivery;

class MailsController extends Controller
{
    public function getStatistics(Request $request)
    {

        // IMPORTANT:
        // ON Production Servers, Statistics should be collected from cache NOT by hitting the database,
        // But as it's not a requirement for this test, I am getting statistics by querying the database.
        return [
            'totalEmails' => Mail::get()->count(),
            'deliveredEmails' => Mail::where("status", 1)->get()->count(),
            'failedEmails' => Mail::where("status", 0)->get()->count(),
            'activeMTAs' => MTAServer::where("enabled", 1)->get()->count()
        ];
    }

    public function getItems(Request $request)
    {
        $itemsPerPage = 10;
        
        // External input for page must be greater than or equal to 1
        $page = $request->input('page') >= 1 ? $request->input('page') : 1;
        
        // Items to skip before sellecting
        $skip = $itemsPerPage*($page-1);
        
        // Get items count
        $itemsCount = Mail::get()->count();

        return [
            "items" => Mail::skip($skip)->take($itemsPerPage)->get(),
            "itemsCount" => $itemsCount,
            "pages" => ceil($itemsCount/$itemsPerPage),
            "currentPage" => $page
        ];
    }

    public function createItem(Request $request, JETDelivery $jetDelivery)
    {
        // Do Some Validation
        $validator = Validator::make($request->all(), [
            'fromName' => 'required|max:50',
            'fromEmail' => 'required|max:255',
            'toEmail' => 'required',
            'subject' => 'required|max:100',
            'message' => 'required'
        ]);

        if ($validator->fails()) {
          return ["statusCode" => 0, "statusMessage" => "Parameter Validation Failed: Check your inputs."];
        }

        // Get Comma-separated emails to list
        $toEmails = explode(",", $request->get('toEmail'));

        $delaySeconds = 5;

        // Loop over all email addresses and push separate Job for each
        foreach($toEmails as $email)
        {
            $job = (new \App\Jobs\SendMailJob([
                'fromName'=>$request->get('fromName'),
                'fromEmail'=>$request->get('fromEmail'),
                'toEmail'=>trim($email),
                'subject'=>$request->get('subject'),
                'message'=>$request->get('message')
            ], $jetMailer))->delay(\Carbon\Carbon::now()->addSeconds($delaySeconds));
            
            // Delay 5 seconds between each job
            $delaySeconds+=5;

            dispatch($job);
        }

        return ["statusCode" => 1, "statusMessage" => "Email Scheduled for Delivers"];
    }
}
