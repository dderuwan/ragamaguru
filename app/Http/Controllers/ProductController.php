<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(Request $request)
    {
        $name = $request->query('name');
        $price = $request->query('price');
        $image = $request->query('image'); 
        return view('products', compact('name', 'price', 'image'));
    }


}

