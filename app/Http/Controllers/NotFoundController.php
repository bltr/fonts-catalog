<?php

namespace App\Http\Controllers;

use App\Models\NotFound;
use Illuminate\Http\Request;

class NotFoundController extends Controller
{
    public function _404(Request $request)
    {
        NotFound::create([
           'url' => $request->url(),
           'referer' => $request->header('referer'),
           'ip' => $request->ip()
        ]);

        return view('errors.404');
    }
}
