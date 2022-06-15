<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index()
    {
    $view_data = [];
    return view('file.index');
    }

    public function save(Request $request)
    {
       $p = $request['path'];
       dd($p->getClientOriginalName());
    }
}
