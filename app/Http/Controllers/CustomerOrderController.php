<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerOrderItems;
use App\Models\CustomerOrders;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CustomerOrderController extends Controller
{
    public function placeOrder(Request $request)
    {

        $data = $request->json()->all();
        $pmethod = $data['pmethod'];

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
                $customerOrder = CustomerOrders::create([
                    'cus_order_code' => $this->generateOrderCode(),
                    'customer_code' => $userId,
                    'date' => Carbon::today(),
                    'sub_total' => $subTotal,
                    'shipping_cost' => $shippingCost,
                    'grand_total' => $grandTotal,
                    'paid_amount' => 0.00,
                    'payment_type' => $pmethod,
                    'order_status_id' => 1,
                ]);

                foreach ($cartDetails as $item) {
                    $itemCode = $item['item_code'];
                    $quantity = $item['quantity'];
                    $itemName = $item['item_name'];

                    CustomerOrderItems::create([
                        'cus_order_id' => $customerOrder->id,
                        'item_code' => $itemCode,
                        'item_name' => $itemName,
                        'quantity' => $quantity,
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
        return 'CORD-'  . rand(1000, 9999);
    }


    public function clearCheckout(){
        session()->forget('cart');
        Session::forget('checkoutDetails');
    }
}
