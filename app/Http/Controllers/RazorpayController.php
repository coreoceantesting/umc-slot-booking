<?php
namespace App\Http\Controllers;

use Razorpay\Api\Api;
use Illuminate\Http\Request;

class RazorpayController extends Controller
{
    public function createOrder(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));
    
        $orderData = [
            'receipt'         => 'receipt_' . $request->id, 
            'amount'          => $request->amount * 100,   
            'currency'        => 'INR',
            'payment_capture' => 1 
        ];
        // print_r($orderData);
        // exit;
        try {
            $order = $api->order->create($orderData);
            return response()->json(['order' => $order]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function verifyPayment(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

        $attributes = [
            'razorpay_order_id'   => $request->razorpay_order_id,
            'razorpay_payment_id'  => $request->razorpay_payment_id,
            'razorpay_signature'   => $request->razorpay_signature
        ];

        try {
            $api->utility->verifyPaymentSignature($attributes);
            return response()->json(['status' => 'Payment verified']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'Payment verification failed', 'error' => $e->getMessage()]);
        }
    }
}

