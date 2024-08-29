<?php
namespace App\Services\payments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
class MoyasarService
{
    protected $apiKey;
    protected $apiUrl;

    public function __construct()
    {
        $this->apiKey = env('MOYASAR_API_KEY');
        $this->apiUrl = env('MOYASAR_API_URL');
    }

    public function createPayment($amount, $currency, $source, $description, $callbackUrl)
    {
        $user = Auth::user();

        $response = Http::withBasicAuth($this->apiKey, '')
            ->post($this->apiUrl, [
                'amount' => $amount,
                'currency' => $currency,
                'source' => $source,
                'description' => $description,
                'callback_url' => $callbackUrl,
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                ],
            ]);

        return $response->json();
    }




}
