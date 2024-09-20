<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\Bookings;
use App\Models\CompanyDetails;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Item;
use App\Models\OfferItems;
use App\Models\Order;
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

        $companyDetails = CompanyDetails::first();
        $yt_channel_id = $companyDetails ? $companyDetails->yt_channel_id : null;
        $fb_page_url = $companyDetails ? $companyDetails->fb_page_url : null;

        return view('home', compact('item_list', 'offer_items', 'yt_channel_id', 'fb_page_url'));
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


    public function goToProfile()
    {
        //add user to session - id is 1
        Session::put('user_id', 1); //testing purpose 

        $logged_user_id = Session::get('user_id');
        if (empty($logged_user_id)) {
            return redirect()->back()->with('error', 'Please Login first');
        } else {
            $customer = Customer::with('customerType', 'countryType', 'country')->find($logged_user_id);

            if ($customer) {
                $countries = Country::all();
                $orders = Order::where('customer_code', $customer->id)
                    ->where('order_type', 'Online')
                    ->with('orderStatus')
                    ->get();

                $today = Carbon::today();

                $bookings = Appointments::where('customer_id', $customer->id)
                    ->whereDate('date', '>=', $today)
                    ->get();

                return view('profile', compact('customer', 'bookings', 'orders', 'countries'));
            }
        }
    }

    public function showOrderDetails($orderId)
    {
        $order = Order::with('items', 'orderStatus')->findOrFail($orderId);
        return response()->json($order);
    }

    public function updateCusDetails(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        if ($customer) {

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'country_id' => 'nullable',
            ]);

            $customer->update($validated);

            return redirect()->back()->with('success', 'Personal details updated successfully!');
        } else {
            return redirect()->back()->with('error', 'User not found');
        }
    }
}
