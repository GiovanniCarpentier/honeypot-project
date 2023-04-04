<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
session_start();
use App\Models\Product;

class ShopController extends Controller
{
    public function getItems($name)
    {
        $products = Product::where('name', $name)->orWhere('name', 'like', '%' . $name . '%')->get();

            return view('shop', ['name' => $name, "products" => $products]);
    }

    function shop(Request $request) {
        $products = Product::all();
        return view("/shop", ["products" => $products]);
    }

}
