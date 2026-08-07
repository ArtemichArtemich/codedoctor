<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data\CasesData;

class HomeController extends Controller
{
    public function index()
    {
        $cases = CasesData::all();
        // dd($cases);
        return view('pages.home', compact('cases'));
    }
}