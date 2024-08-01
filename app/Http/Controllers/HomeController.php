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
        // $item_list = Item::inRandomOrder()->take(4)->get();

        $currentMonth = Carbon::now()->format('Y-m');

        $item_list = Item::whereNotIn('id', function ($query) use ($currentMonth) {
            $query->select('item_id')
                  ->from('offer_item')
                  ->where('month', $currentMonth)
                  ->where('status', 'active');  
        })->inRandomOrder()->take(4)->get();

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

        $currentMonth = now()->format('Y-m');

        $item_list = Item::leftJoin('offer_item', function ($join) use ($currentMonth) {
            $join->on('item.id', '=', 'offer_item.item_id')
                ->where('offer_item.month', '=', $currentMonth)
                ->where('offer_item.status', '=', 'active');
        })
            ->select('item.*', 'offer_item.offer_rate', 'offer_item.offer_price', 'offer_item.normal_price')
            ->get();

        return view('store', compact('item_list'));   
    }
}
