<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogController extends Controller
{
    function list(Request $request)
    {
        return view ('home');
    }
    function detail (string $id, Request $request)
    {
        $data = [
            'id'=> $id
        ];
        return view('detail', $data);
    }
};
