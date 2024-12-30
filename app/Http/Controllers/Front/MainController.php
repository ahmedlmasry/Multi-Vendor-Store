<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(CartRepository $cart){
        $products = Product::take(8)->get();
        return view('front.home',compact('products','cart'));
    }

}
