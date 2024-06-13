<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Enums\IsHas;
use App\Http\Controllers\Controller;
use App\Http\Requests\StripeConfigureRequest;
use App\Models\SubscriptionRequest;
use App\Repositories\GeneralSettingRepository;
use App\Repositories\ShopSubscriptionRepository;
use App\Repositories\SubscriptionRequestRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe;

class PaymentGatewayController extends Controller
{
    public function index()
    {
        return view('paymentGateway.index');
    }

    public function update(StripeConfigureRequest $request)
    {
        $environmentSet = array(
            'STRIPE_KEY' => $request->public_key,
            'STRIPE_SECRET' => $request->secret_key,
        );
        foreach ($environmentSet as $key => $value) {
            self::setEnv($key, $value);
        }
        return back()->with('success', 'Stripe payment gateway successfully configure');
    }

    public function payment()
    {
        return view('subscriptionPurchase.payment');
    }

    public function process(Request $request, SubscriptionRequest $subscriptionRequest)
    {
        $generalsettings = GeneralSettingRepository::query()->whereNull('shop_id')->first();

        try {
            Stripe\Stripe::setApiKey(config("app.stripe_sk"));
            Stripe\Charge::create([
                "amount" => $subscriptionRequest->subscription->price * 100,
                "currency" => $generalsettings?->defaultCurrency?->code ?? 'USD',
                "source" => $request->stripeToken,
                "description" => $subscriptionRequest->subscription->description,
            ]);

            $shopSubscription = ShopSubscriptionRepository::query()->where([
                'is_current' => IsHas::YES->value,
                'shop_id' => $this->mainShop()->id
            ])->first();

            if ($shopSubscription) {
                $shopSubscription->update([
                    'is_current' => IsHas::NO->value,
                ]);
            }
            SubscriptionRequestRepository::updateByRequest($subscriptionRequest);
            ShopSubscriptionRepository::storeByRequest($subscriptionRequest);
            return to_route('root')->with('success', 'Stripe payment successfully done');
        } catch (Exception $ex) {
            SubscriptionRequestRepository::requestFailed($subscriptionRequest);
            return to_route('subscription.purchase.index')->withError('Something is wrong please try again');;
        }
    }

    protected function setEnv($key, $value): bool
    {
        try {
            $envFile = app()->environmentFilePath();
            $str = file_get_contents($envFile);

            // Check if the key exists in the .env file
            if (strpos($str, "{$key}=") === false) {
                $str .= "{$key}={$value}\n";
            } else {
                $str = preg_replace("/{$key}=.*/", "{$key}={$value}", $str);
            }

            // Trim both key and value to remove leading/trailing whitespaces
            $str = rtrim($str) . "\n";

            // Update the .env file
            file_put_contents($envFile, $str);

            return true;
        } catch (Exception $e) {
            // Log or report the exception
            Log::error("Error updating environment variable: {$e->getMessage()}");
            return false;
        }
    }
}
