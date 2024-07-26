<?php

namespace App\Http\Controllers;

use App\Models\CartPaymentTypes;
use App\Models\Customer;
use App\Models\PaymentTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $btnName = $request->input('btn_name');

        $product = [
            'item_code' => $request->input('item_code'), 
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'image' => $request->input('image'),
        ];
        $cart = session()->get('cart', []);
        $cart[] = $product;
        session()->put('cart', $cart);

        if($btnName=='buy'){
            return redirect()->route('cart');
        }elseif($btnName=='cart'){  
            session()->flash('success', 'Product added to cart successfully!');
            return redirect()->back();
        }

        
    }


    public function showCart()
    {
        $cart = session()->get('cart', []);
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
