<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContentManagerController extends Controller
{
    public function index(){
        return view('content_manager.index');
    }
}
