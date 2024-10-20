<?php

namespace App\Http\Controllers;

use App\Models\CartPaymentTypes;
use App\Models\Customer;
use App\Models\DeliveryAddress;
use App\Models\Item;
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

        if ($btnName == 'buy') {
            return redirect()->route('cart');
        } elseif ($btnName == 'cart') {
            session()->flash('success', 'Product added to cart successfully!');
            return redirect()->back();
        }
    }


    public function showCart()
    {
        $cart = session()->get('cart', []);

        // Retrieve product data including available quantity
        foreach ($cart as &$item) {
            // Fetch product from the database using item_code
            $product = Item::where('item_code', $item['item_code'])->first();
            if ($product) {
                $item['available_quantity'] = $product->quantity;
            } else {
                $item['available_quantity'] = 0; // Default if product not found
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

    public function getShippingCost($userId)
    {
        $deliveryAddress = DeliveryAddress::where('customer_id', $userId)->first();
        $shippingCost = null;
        if ($deliveryAddress) {
            $country = $deliveryAddress->country;
            if ($country != 'LK') {
                $shippingCost = 500;
            } else {
                $shippingCost = 0;
            }
        } else {
            $shippingCost = 0;
        }
        return $shippingCost;
    }


    public function storeCartDetails(Request $request)
    {

        $userId = Session::get('customer_id');
        $cart = session()->get('cart', []);

        if (empty($userId)) {
            return response()->json(['success' => false, 'message' => 'no user']);
        } else if (empty($cart)) {
            return response()->json(['success' => false, 'message' => 'no cart']);
        } else {
            $cartDetails = $request->input('cartDetails');
            $subTotal = $request->input('totalCartPrice');

            $data['cartDetails'] = $cartDetails;
            $data['subTotal'] = number_format($subTotal, 2);

            Session::put('checkoutDetails', $data);

            return response()->json(['success' => true]);
        }
    }


    public function cartCheckout()
    {

        $checkoutDetails = Session::get('checkoutDetails', []);
        $logged_user_id = Session::get('customer_id');
        $paymentTypes = CartPaymentTypes::all();
        $userDetails = Customer::findOrFail($logged_user_id);

        $subTotal = $checkoutDetails['subTotal'];
  
        $getShippingCost = $this->getShippingCost($userDetails->id);
        $shippingCost = number_format($getShippingCost, 2);
        $grandTotal = $subTotal + $shippingCost;

        $checkoutDetails['shippingCost'] = $shippingCost;
        $checkoutDetails['grandTotal'] = number_format($grandTotal, 2); 

        Session::put('checkoutDetails', $checkoutDetails);

        $deliveryAddress = DeliveryAddress::where('customer_id', $logged_user_id)->first();

        return view('cartcheckout', compact('checkoutDetails', 'paymentTypes', 'userDetails', 'deliveryAddress'));
    }
}
