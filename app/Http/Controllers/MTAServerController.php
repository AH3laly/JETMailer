<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\MTAServer;

class MTAServerController extends Controller
{
    public function getItems(Request $request)
    {
        $itemsPerPage = 10;
        
        // External input for page must be greater than or equal to 1
        $page = $request->input('page') >= 1 ? $request->input('page') : 1;
        
        // Items to skip before sellecting
        $skip = $itemsPerPage*($page-1);
        
        // Get items count
        $itemsCount = MTAServer::get()->count();

        return [
            "items" => MTAServer::skip($skip)->take($itemsPerPage)->orderByDesc('id')->get(),
            "itemsCount" => $itemsCount,
            "pages" => ceil($itemsCount/$itemsPerPage),
            "currentPage" => $page
        ];
    }
}
