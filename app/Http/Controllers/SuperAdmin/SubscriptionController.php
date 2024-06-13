<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Enums\RecurringType;
use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriptionRequest;
use App\Models\Subscription;
use App\Repositories\ShopSubscriptionRepository;
use App\Repositories\SubscriptionRepository;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = SubscriptionRepository::getAll();
        $recurringTypes = RecurringType::cases();
        $statuses = Status::cases();
        return view('subscription.index', compact('subscriptions', 'recurringTypes', 'statuses'));
    }

    public function store(SubscriptionRequest $request)
    {
        SubscriptionRepository::storeByRequest($request);
        return back()->with('success', 'Subscription is created successfully');
    }

    public function update(SubscriptionRequest $request, Subscription $subscription)
    {
        SubscriptionRepository::updateByRequest($request, $subscription);
        return back()->with('success', 'Subscription is updated successfully');
    }

    public function statusChanage(Subscription $subscription, $status)
    {
        SubscriptionRepository::statusChanageByRequest($subscription, $status);
        return back()->with('success', 'Subscription successfully chanaged');
    }

    public function report()
    {
        $shopSubscriptions = ShopSubscriptionRepository::getAll();
        if ($this->mainShop()) {
            $shopSubscriptions = ShopSubscriptionRepository::query()->where('shop_id', $this->mainShop()->id)->orderByDesc('id')->get();
        }
        return view('subscription.report', compact('shopSubscriptions'));
    }
}
