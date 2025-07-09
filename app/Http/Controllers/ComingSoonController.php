<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComingSoonController extends Controller
{
    /**
     * Display the coming soon page.
     */
    public function index()
    {
        return view('seller.coming-soon.index');
    }
    public function indexAdmin()
    {
        return view('admin.coming-soon.index');
    }
}