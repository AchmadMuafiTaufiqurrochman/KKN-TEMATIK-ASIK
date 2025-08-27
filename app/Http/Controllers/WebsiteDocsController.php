<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteDocsController extends Controller
{
    public function index()
    {
        return view('website-docs');
    }
}
