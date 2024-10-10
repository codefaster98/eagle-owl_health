<?php

namespace App\Http\Controllers\Api\Payment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;
use App\Models\Events\EventsEventsM;
use Illuminate\Support\Facades\Auth;
use App\Services\payments\MoyasarService;
use Nafezly\Payments\Classes\HyperPayPayment;
use App\Models\MemberShips\MemberShipsMemberShipM;

class payments extends Controller
{

    public function requestPayment($eventCode)
    {
        $user = auth()->user();
        $event = EventsEventsM::where('code', $eventCode)->first();
        if (!$event) {
            return response()->json(['error' => 'Event not found.'], 404);
        }

        $amount = $event->price;
        $formattedAmount = number_format((float)$amount, 2, '.', '');

        $url = env('HYPERPAY_URL');
        $data = "entityId=" . env('HYPERPAY_CREDIT_ID') .
                "&amount=" . $formattedAmount .
                "&currency=" . env('HYPERPAY_CURRENCY', "SAR") .
                "&paymentType=DB" .
                "&integrity=true";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer ' . env('HYPERPAY_TOKEN')
        ));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $responseData = curl_exec($ch);

        if (curl_errno($ch)) {
            return response()->json(['error' => curl_error($ch)], 500);
        }

        curl_close($ch);
        return response()->json([
            'user_name' => $user->fname,
            'user_phone' => $user->phone,
            'amount' => $formattedAmount,
            'payment_response' => json_decode($responseData)
        ]);
    }
    // public function makePayment(Request $request,$eventCode)
    // {
    //     $user=auth()->user();
    //     $event = EventsEventsM::where('code', $eventCode)->first();
    //         if (!$event) {
    //             return response()->json(['error' => 'Event not found.'], 404);
    //         }
    //     $amount=$event->price;
    //     $payment = new HyperPayPayment();
    //     $response = $payment->pay(
    //         amount: $amount,
    //         user_id: $user->id,
    //         user_first_name: $user->fname,
    //         user_last_name: $user->lname,
    //         user_email: $user->email,
    //         user_phone: $user->phone,
    //     );
    //     Log::info('HyperPay response: ' . $responseData);

    //     if (isset($response['payment_id'])) {
    //         return response()->json($response);
    //     } else {
    //         return response()->json(['error' => 'Payment failed'], 500);
    //     }
    // }

public function checkout(Request $request)
{
    $event = EventsEventsM::where('code', $request->input('code'))->first();
    if (!$event) {
        return response()->json(['error' => 'Event not found'], 404);
    }
    $user = Auth::user();
    $url = "https://eu-test.oppwa.com/v1/checkouts";
    $data = [
        'entityId' => 'YOUR_ENTITY_ID',
        'amount' => $event->price,
        'currency' => 'SUR',
        'paymentType' => 'DB'
    ];
    $response = Http::post($url, array_merge($data, [
        'authentication.userId' => 'YOUR_USER_ID',
        'authentication.password' => 'YOUR_PASSWORD'
    ]));
    if ($response->successful()) {
        $checkoutId = $response->json()['id'];
        return response()->json([
            'checkoutId' => $checkoutId,
            'userName' => $user->name,
            'eventName' => $event->name
        ]);
    } else {
        return response()->json(['error' => 'Error processing payment'], 500);
    }
}


public function paymentStatus(Request $request)
{
    $resourcePath = $request->input('resourcePath');
    $url = "https://eu-test.oppwa.com" . $resourcePath;
    $response = Http::get($url, [
        'entityId' => 'YOUR_ENTITY_ID',
        'authentication.userId' => 'YOUR_USER_ID',
        'authentication.password' => 'YOUR_PASSWORD'
    ]);
    $paymentStatus = $response->json();
    if (isset($paymentStatus['result']['code']) && $paymentStatus['result']['code'] == '000.100.110') {
        return response()->json(['message' => 'Payment successful']);
    } else {
        return response()->json(['message' => 'Payment failed'], 400);
    }
}


}
