<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Newsletter;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        if(empty($request['email'])||empty($request['state'])) {
            http_response_code(500);
        }

        Newsletter::firstOrCreate(
            ['email' => $request['email']],		//search db for existing email
            ['state_id' => $request['state']]		//create new if not found
        );

        return redirect()->route('home');
    }
}
