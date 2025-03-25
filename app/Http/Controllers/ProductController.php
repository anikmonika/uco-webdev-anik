<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->validate([
                'name' => ['required'],
                'description' => [],
                'price' => ['required', 'numeric', 'min:0'],
                'images' => ['required', 'array'],
                'images.*' => ['required_without:images_urls.*', File::image()->max(5 * 1024)],
                'images_urls' => ['array'],
                'images_urls.*' => ['required_without:images.*', 'url']
            ]);

            $product = Product::create($data);
            if ($product) {
                if ($request->has('images')) {
                    foreach ($request->file('images') as $file) {
                        $extension = $file->getClientOriginalExtension();
                        $filename = uniqid().'.'.$extension;

                        $file->move('storage/product', $filename);

                        ProductImage::create([
                            'product_id' => $product->id,
                            'name' => $filename
                        ]);
                    }
                }

                if ($request->has('images_urls')) {
                    foreach ($request->input('images_urls') as $url) {
                        $contents = file_get_contents($url);
                        $extension = pathinfo($url, PATHINFO_EXTENSION);
                        $filename = uniqid().'.'.$extension;

                        file_put_contents('storage/product/'.$filename, $contents);

                        ProductImage::create([
                            'product_id' => $product->id,
                            'name' => $filename
                        ]);
                    }
                }

                return redirect()->route('catalog-detail', ['id' => $product->id]);
            }

            return back()->withInput();
        }

        return view('product.form');
    }

    function edit(string $id, Request $request)
    {
        $product = Product::where('id', $id)->first();

        Gate::authorize('edit_product', $product);

        if ($request->isMethod('post')) {
            $data = $request->validate([
                'name' => ['required'],
                'description' => [],
                'price' => ['required', 'numeric', 'min:0'],
                'images' => ['array'],
                'images.*' => ['required_without:images_urls.*', File::image()->max(5 * 1024)],
                'images_urls' => ['array'],
                'images_urls.*' => ['required_without:images.*', 'url']
            ]);

            if ($product->update($data)) {
                if ($request->has('images')) {
                    foreach ($request->file('images') as $file) {
                        $extension = $file->getClientOriginalExtension();
                        $filename = uniqid().'.'.$extension;

                        $file->move('storage/product', $filename);

                        ProductImage::create([
                            'product_id' => $product->id,
                            'name' => $filename
                        ]);
                    }
                }

                if ($request->has('images_urls')) {
                    foreach ($request->input('images_urls') as $url) {
                        $contents = file_get_contents($url);
                        $extension = pathinfo($url, PATHINFO_EXTENSION);
                        $filename = uniqid().'.'.$extension;

                        file_put_contents('storage/product/'.$filename, $contents);

                        ProductImage::create([
                            'product_id' => $product->id,
                            'name' => $filename
                        ]);
                    }
                }

                return redirect()->route('catalog-detail', ['id' => $product->id]);
            }

            return back()->withInput();
        }

        return view('product.form', [
            'product' => $product
        ]);
    }
}