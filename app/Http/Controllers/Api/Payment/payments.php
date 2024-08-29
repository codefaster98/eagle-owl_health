<?php

namespace App\Http\Controllers\Api\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Events\EventsEventsM;
use Illuminate\Support\Facades\Auth;
use App\Services\payments\MoyasarService;
class payments extends Controller
{
    protected $moyasarService;

    public function __construct(MoyasarService $moyasarService)
    {
        $this->moyasarService = $moyasarService;
    }

    public function processPayment(Request $request,$id)
    {
        $request->validate([
            'currency' => 'required|string',
            'source' => 'required|array',
            'callback_url' => 'required|url',
        ]);

        $user = Auth::user();
        $event = EventsEventsM::find($id);

        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        $amount = (int)($event->price*100);
        $source = $request->source;
        $source['name'] = $user->fname . ' ' . $user->lname;
        $description = "Payment for event " . $event->title_en;

        $payment = $this->moyasarService->createPayment(
            $amount,
            $request->currency,
            $source,
            $description,
         $request->callback_url
        );
// dd($payment);
        if (!isset($payment['id']) || !isset($payment['status'])) {
            return response()->json([
                'message' => 'Payment failed or invalid response from Moyasar',
                'response' => $payment,
            ], 400);
        }

        $transactionUrl = $payment['source']['transaction_url'] ?? null;

if (!$transactionUrl) {
    return response()->json([
        'message' => 'Failed to retrieve transaction URL.',
        'response' => $payment,
    ], 400);
}
      $name=$user->fname." ".$user->lname;
        return response()->json([
            'id' => $payment['id'],
            'transaction_url' =>$transactionUrl,

        ]);
    }
}
