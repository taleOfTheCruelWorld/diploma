<?php

namespace App\Http\Controllers;

class ContentManagerController extends Controller
{
    public function index(){
        return view('content_manager.index');
    }
}
