<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Repositories\SubscriptionRepository;
use App\Repositories\SubscriptionRequestRepository;
use Illuminate\Http\Request;

class SubscriptionPurchaseController extends Controller
{
    public function index()
    {
        $subscriptions = SubscriptionRepository::query()->where('status', 'Active')->get();
        return view('subscriptionPurchase.index', compact('subscriptions'));
    }

    public function update(Subscription $subscription)
    {
        $subscriptionRequest = SubscriptionRequestRepository::storeByRequest($subscription);
        return view('subscriptionPurchase.payment', compact('subscription', 'subscriptionRequest'));
    }
}
