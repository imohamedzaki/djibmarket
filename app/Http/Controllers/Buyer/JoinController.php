<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JoinController extends Controller
{
    public function index()
    {
        return view('buyer.join.index');
    }
}
