<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    private $merchantApiKey = '$2a$10$B4rws8envr3WD5OFfyiYpeb8r3TUZGM4HGpXEnnh5RTP1eIz8g9wC'; // Set your merchant API key
    private $sandboxUrl = 'https://app.marx.lk/api/v3/ipg/orders';

    public function createOrder(Request $request)
    {
        // Validate the incoming request
        

        // Prepare the request data
        $data = [
            "merchantRID" => 'ord_948623',
            "amount" => 100.00,
            "validTimeLimit" => 2,
            "returnUrl" => route('paymentResult'),
            "customerMail" => 'himashahiru921@gmail.com',
            "customerMobile" => '0741225494',
            "mode" => 'WEB',
            "orderSummary" => 'oder_9847',
            "customerReference" => '0741225494',
            "paymentMethod" => 'VISA_MASTERCARD',
        ];

        // Send request to create an order
        $response = Http::withHeaders([
            'merchant-api-key' => $this->merchantApiKey,
        ])->post($this->sandboxUrl, $data);

        if ($response->successful()) {
            $payUrl = $response['data']['payUrl'];
            return redirect($payUrl); // Redirect the user to the payment URL
        }

        return back()->withErrors('Order creation failed. Please try again.');
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
            return view('payment.success', ['data' => $paymentResponse['data']]);
        } else {
            return view('payment.failure', ['message' => $paymentResponse['message']]);
        }
    }

    private function initiatePayment($trId, $merchantRID)
    {
        $url = $this->sandboxUrl . "/$trId"; // URL to initiate payment

        $response = Http::withHeaders([
            'merchant-api-key' => $this->merchantApiKey,
        ])->put($url, ['merchantRID' => $merchantRID]);

        return $response->json();
    }
}
