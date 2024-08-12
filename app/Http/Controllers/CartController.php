<?php

namespace App\Http\Controllers;

use App\Models\CartPaymentTypes;
use App\Models\Customer;
use App\Models\Item;
use App\Models\PaymentTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request)
{
    $btnName = $request->input('btn_name');

    $itemCode = $request->input('item_code');
    $name = $request->input('name');
    $price = $request->input('price');
    $image = $request->input('image');

    // Validate required fields
    if (!$itemCode || !$name || !$price) {
        return redirect()->back()->with('error', 'Item code, name, and price are required.');
    }

    $product = [
        'item_code' => $itemCode,
        'name' => $name,
        'price' => $price,
        'image' => $image,
    ];

    $cart = session()->get('cart', []);

    // Check if the item already exists in the cart
    $exists = false;
    foreach ($cart as &$item) {
        if ($item['item_code'] === $itemCode) {
            $exists = true;
            break;
        }
    }

    if (!$exists) {
        $cart[] = $product;
        session()->put('cart', $cart);
    }

    if ($btnName == 'buy') {
        return redirect()->route('cart');
    } elseif ($btnName == 'cart') {
        session()->flash('success', 'Product added to cart successfully!');
        return redirect()->back();
    }

    return redirect()->back()->with('error', 'Invalid button action.');
}



public function showCart()
{
    $cart = session()->get('cart', []);

    // Debug cart contents
    \Log::info('Cart Contents:', $cart);

    foreach ($cart as &$item) {
        // Ensure 'item_code' key exists before accessing it
        if (isset($item['item_code'])) {
            // Fetch product from the database using item_code
            $product = Item::where('item_code', $item['item_code'])->first();
            if ($product) {
                $item['available_quantity'] = $product->quantity;
            } else {
                $item['available_quantity'] = 0; // Default if product not found
            }
        } else {
            // Handle case where 'item_code' is missing
            $item['available_quantity'] = 0;
        }
    }

    $cartCount = count($cart);
    return view('cart', compact('cart', 'cartCount'));
}




    public function deleteFromCart(Request $request)
    {
        $rowId = $request->input('rowId');
        $cart = session()->get('cart', []);

        if (isset($cart[$rowId])) {
            unset($cart[$rowId]);
            session()->put('cart', $cart); // Save updated cart back to session

            // Return success response
            return response()->json(['success' => true]);
        }
    }



    public function getItemCount()
    {
        $cart = session()->get('cart', []);
        $count = count($cart);
        return response()->json(['count' => $count]);
    }


    public function clearCart(Request $request)
    {
        $request->session()->forget('cart'); // Remove the 'cart' session variable
        return response()->json(['success' => true]);
    }


    public function storeCartDetails(Request $request)
    {
        //add user to session - id is 1
        Session::put('user_id', 1); //testing purpose 

        $userId = Session::get('user_id');
        $cart = session()->get('cart', []);

        if (empty($userId)) {
            return response()->json(['success' => false, 'message'=>'no user']);
        }else if(empty($cart)){
            return response()->json(['success' => false, 'message'=>'no cart']);
        } else {
            $cartDetails = $request->input('cartDetails');
            $subTotal = $request->input('totalCartPrice');
            $shippingCost = $request->input('shippingCost');
            $grandTotal = $request->input('grandTotal');

            $data['cartDetails'] = $cartDetails;
            $data['subTotal'] = $subTotal;
            $data['shippingCost'] = $shippingCost;
            $data['grandTotal'] = $grandTotal;

            Session::put('checkoutDetails', $data);

            return response()->json(['success' => true]);
        }
    }


    public function cartCheckout()
    {

        $checkoutDetails = Session::get('checkoutDetails', []);
        $logged_user_id = Session::get('user_id');
        $paymentTypes = CartPaymentTypes::all();
        $userDetails = Customer::findOrFail($logged_user_id);


        return view('cartcheckout', compact('checkoutDetails', 'paymentTypes', 'userDetails'));
    }
}
