<?php

namespace App\Http\Controllers;
use App\Models\Item;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard.index');
    }

    // public function register()
    // {
    //     return view('customer.create');
    // }


    public function getItems()
    {
        $item_list = Item::all();
        return view('home', compact('item_list')); 
    }

    public function getproducts()
    {
        $item_list = Item::all();
        return view('store', compact('item_list')); 
    }

}
