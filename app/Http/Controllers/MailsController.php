<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Mail;
use App\Models\MTAServer;

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

    public function createItem(Request $request)
    {
        
    }
}
