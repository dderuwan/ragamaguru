<?php

namespace App\Http\Controllers;

use App\Models\CartPaymentTypes;
use App\Models\Customer;
use App\Models\CustomerOrderItems;
use App\Models\CustomerOrders;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CustomerOrderController extends Controller
{
    public function placeOrder(Request $request)
    {

        $data = $request->json()->all();
        $pmethod = $data['pmethod'];
        $paymentType = CartPaymentTypes::find($pmethod);

        $checkoutDetails = Session::get('checkoutDetails');
        $userId = Session::get('user_id');

        if (!$checkoutDetails || !$userId) {
            return response()->json(['success' => false, 'message' => 'No checkout details or user details found in session']);
        } else {

            $cartDetails = $checkoutDetails['cartDetails'];
            $subTotal = $checkoutDetails['subTotal'];
            $shippingCost = $checkoutDetails['shippingCost'];
            $grandTotal = $checkoutDetails['grandTotal'];

            DB::beginTransaction();

            try {
                $customerOrder = Order::create([
                    'order_code' => $this->generateOrderCode(),
                    'customer_code' => $userId,
                    'date' => Carbon::today(),
                    'sub_total' => $subTotal,
                    'shipping_cost' => $shippingCost,
                    'total_cost_payment' => $grandTotal,
                    'paid_amount' => 0.00,
                    'payment_type' => $paymentType->name,
                    'order_status_id' => 1,
                    'order_type' => 'Online',


                ]);

                foreach ($cartDetails as $item) {
                    $itemCode = $item['item_code'];
                    $quantity = $item['quantity'];
                    $itemName = $item['item_name'];
                    $totalPrice = $item['total_price'];

                    OrderItems::create([
                        'pos_id' => $customerOrder->id,
                        'item_code' => $itemCode,
                        'item_name' => $itemName,
                        'quantity' => $quantity,
                        'total_cost' => $totalPrice,
                    ]);

                    //reduce qty
                    $dbItem = Item::where('item_code', $itemCode)->first();

                    if ($dbItem) {
                        $dbItem->quantity -= $quantity;
                        $dbItem->save();
                    } else {
                        DB::rollBack();
                        return response()->json(['success' => false, 'message' => 'Item not found: ' . $itemCode]);
                    }
                }

                DB::commit();

                $this->clearCheckout();

                return response()->json(['success' => true, 'message' => 'Order Placed Successfully.']);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => 'Failed to place order. Error: ' . $e->getMessage()]);
            }
        }
    }

    private function generateOrderCode()
    {
        return 'ORD-'  . rand(1000, 9999);
    }


    private $paymentGatewayUrl = 'https://dev.app.marx.lk/api/v3/ipg/orders';

    public function createPaymentOrder(Request $request)
    {
        $checkoutDetails = Session::get('checkoutDetails');
        $userId = Session::get('user_id');

        if (!$checkoutDetails || !$userId) {
            return response()->json(['success' => false, 'message' => 'No checkout details or user details found in session']);
        }

        $data = [
            'merchantRID' => $request->merchantRID,
            'amount' => $checkoutDetails['grandTotal'],
            'validTimeLimit' => 2, // Transaction valid for 2 hours
            "returnUrl" => route('paymentResult'),
            'customerMobile' => $request->customerMobile,
            'mode' => 'WEB',
            'orderSummary' => $request->orderSummary,
            'customerReference' => $request->customerMobile,
            'paymentMethod' => $request->paymentMethod,
            'threeDSecure' => true 
        ];

        $response = Http::withHeaders([
            'merchant-api-key' => env('MARX_API_KEY'),
        ])->post($this->paymentGatewayUrl, $data);

        if ($response->successful()) {
            $paymentUrl = $response->json('data.payUrl');
            return response()->json([
                'success' => true,
                'paymentUrl' => $paymentUrl
            ]);
        } else {
            Log::error('Payment Order Failed: ' . $response->body()); // Log error response
            return response()->json([
                'success' => false,
                'message' => 'Failed to create payment order. Please try again.'
            ]);
        }
    }

    public function paymentResult(Request $request)
    {
        $trId = $request->input('trId');
        $merchantRID = $request->input('merchantRID');    

        // Validate the query parameters
        if (!$trId || !$merchantRID) {
            return redirect('/')->withErrors('Invalid payment parameters.');
        }

        // Initiate the payment using the trId
        $paymentResponse = $this->initiatePayment($trId, $merchantRID);

        // Check the payment response status
        if ($paymentResponse['status'] === 0 && $paymentResponse['data']['summaryResult'] === 'SUCCESS') {
            $this->placeOrderAfterPayment($merchantRID);
                return redirect()->route('store')->with('success', 'Payment successful! Order placed.');
        } else {
            return redirect()->route('store')->with('error', 'Payment failed. Please try again.');
        }
    }

    

    private function initiatePayment($trId, $merchantRID)
    {
        $url = $this->paymentGatewayUrl . "/$trId"; // URL to initiate payment

        $response = Http::withHeaders([
            'merchant-api-key' => env('MARX_API_KEY'),
        ])->put($url, ['merchantRID' => $merchantRID]);

        return $response->json();
    }

    private function placeOrderAfterPayment($merchantRID)
    {
        // Retrieve cart and user details from session
        $checkoutDetails = Session::get('checkoutDetails');
        $userId = Session::get('user_id');

        DB::beginTransaction();

        try {
            $customerOrder = Order::create([
                'order_code' => $merchantRID,
                'customer_code' => $userId,
                'date' => Carbon::today(),
                'sub_total' => $checkoutDetails['subTotal'],
                'shipping_cost' => $checkoutDetails['shippingCost'],
                'total_cost_payment' => $checkoutDetails['grandTotal'],
                'paid_amount' => $checkoutDetails['grandTotal'],
                'payment_type' => 'Card',
                'order_status_id' => 1,
                'order_type' => 'Online',
            ]);

            foreach ($checkoutDetails['cartDetails'] as $item) {
                OrderItems::create([
                    'pos_id' => $customerOrder->id,
                    'item_code' => $item['item_code'],
                    'item_name' => $item['item_name'],
                    'quantity' => $item['quantity'],
                    'total_cost' => $item['total_price'],
                ]);
            }

            DB::commit();
            $this->clearCheckout();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }



    public function clearCheckout()
    {
        session()->forget('cart');
        Session::forget('checkoutDetails');
    }


    public function onlineOrders()
    {
        $orders = Order::with('orderStatus')->where('order_type', 'Online')->get();
        return view('orders.onlineorders', compact('orders'));
    }

    public function showOnlineOrder($id)
    {
        $orderStatus = OrderStatus::all();
        $order = Order::with(['items', 'customer', 'orderStatus'])->findOrFail($id);
        return view('orders.showonlineorder', compact('order', 'orderStatus'));
    }


    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->items()->delete(); // Delete related order items
        $order->delete(); // Delete the order itself

        notify()->success('Order deleted successfully. ⚡️', 'Success');
        return redirect()->route('onlineorders')->with('success', 'Order deleted successfully.');
    }

    public function changeStatus(Request $request, $id)
    {


        $order = Order::find($id);
        if (!$order) {
            return redirect()->back()->with('error', 'order not found');
        }

        $order->order_status_id = $request->input('status');
        $order->save();

        notify()->success('Status change successfully. ⚡️', 'Success');
        return redirect()->back();
    }
}
