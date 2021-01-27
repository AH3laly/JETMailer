<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Mail;
use App\Models\MTAServer;

class MailsController extends Controller
{
    public function getStatistics(Request $request){

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

    public function getItems(Request $request){

    }

    public function createItem(Request $request){
        
    }
}
