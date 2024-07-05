<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = [
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'image' => $request->input('image'),
        ];
        $cart = session()->get('cart', []);
        $cart[] = $product;
        session()->put('cart', $cart);

        return response()->json(['success' => true]);
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



}
