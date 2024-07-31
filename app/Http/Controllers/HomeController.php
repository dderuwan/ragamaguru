<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\OfferItems;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

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


    public function getHomeData()
    {
        $item_list = Item::inRandomOrder()->take(4)->get();

        $currentMonth = Carbon::now()->format('Y-m');

        $offer_items = DB::table('offer_item')
            ->join('item', 'offer_item.item_id', '=', 'item.id')
            ->select('offer_item.*', 'item.*',)
            ->where('offer_item.month', $currentMonth)
            ->where('offer_item.status', 'active')
            ->get();

        return view('home', compact('item_list', 'offer_items'));
    }

    public function getproducts()
    {

        //add user to session - id is 1
        // Session::put('user_id', 1); //testing purpose 

        $item_list = Item::all();
        return view('store', compact('item_list'));
    }
}
