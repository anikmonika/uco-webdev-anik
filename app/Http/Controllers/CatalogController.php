<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    function list(Request $request)
    {
        $data['search'] = $request->search;
        $data['sort'] = $request->sort ?? 'most recent';

        $products = Product::where(function($query) use ($request) {
            $query->where('name', 'like', '%'.$request->search.'%')
                ->orWhere('description', 'like', '%'.$request->search.'%');
        });

        if ($data['sort'] == 'most recent') {
            $products->orderBy('created_at', 'desc');
        } else if ($data['sort'] == 'lowest price') {
            $products->orderBy('price', 'asc');
        } else if ($data['sort'] == 'highest price') {
            $products->orderBy('price', 'desc');
        } else if ($data['sort'] == 'name a-z') {
            $products->orderBy('name', 'asc');
        } else if ($data['sort'] == 'name z-a') {
            $products->orderBy('name', 'desc');
        }

    }
        function home()
        {
            $products = Product::get();
            $data['products'] = $products;
            return view('home', $data);
        }
    
        function detail(string $id, Request $request)
        {
            $product = Product::where('id', $id)->first();
            $data['product'] = $product;
            return view('detail', $data);
        }
};