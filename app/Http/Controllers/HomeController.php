<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    function index(Request $request)
    {
        $lastQuote = DB::table('quotes')->orderBy('created_at', 'desc')->first();
        return view('home', ['quote' => $lastQuote]);
    }
}
