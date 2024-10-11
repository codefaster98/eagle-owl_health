<?php

namespace App\Http\Controllers\Api\Payment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;
use App\Models\Events\EventsEventsM;
use Illuminate\Support\Facades\Auth;
use App\Services\payments\MoyasarService;
use App\Services\users\UsersUsersServices;
use App\Services\users\EventsEventsServices;
use Nafezly\Payments\Classes\HyperPayPayment;
use App\Models\MemberShips\MemberShipsMemberShipM;
use App\Services\system\SystemApiResponseServices;
use App\Http\Requests\api\payments\EventsEventsCheckoutRequest;

class EventsCheckout extends Controller
{
function Checkout(EventsEventsCheckoutRequest $request)
{
    try {
        // Get event
        $event = EventsEventsServices::GetByCode(null, $request->event_code);

        // Get authenticated user
        $user = UsersUsersServices::Auth();

        // Initialize payment with HyperPay
        $payment = new \Nafezly\Payments\Classes\HyperPayPayment();

        // Perform payment
        $pay = $payment->pay(
            amount: $event->price,
            user_id: $user->code,
            user_first_name: $user->fname,
            user_last_name: $user->lname,
            user_email: $user->email,
            user_phone: $user->phone,
            source: "CREDIT",
        );

        return SystemApiResponseServices::ReturnSuccess($pay, null);

    } catch (\Throwable $th) {
        return SystemApiResponseServices::ReturnFailed([], $th->getMessage());
    }
}
function CheckoutVerify(Request $request)
{
    try {
        //verify function
        $payment = new HyperPayPayment();
        return SystemApiResponseServices::ReturnSuccess($payment->verify($request), null);
    } catch (\Throwable $th) {
        return SystemApiResponseServices::ReturnFailed([], __("global.Error"), $th->getMessage());
    }
}

}
