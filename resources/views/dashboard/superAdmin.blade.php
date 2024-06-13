@extends('layout.app')
@section('title', __('dashboard'))
@section('content')
    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5">
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <div class="report-section-card">
                                <div class="report-section-card-body">
                                    <div class="report-section-card-text">
                                        {{ __('total_subscription_sale') }}
                                    </div>
                                    <div class="report-section-card-image">
                                        <img src="{{ asset('icons/graph.svg') }}" alt="">
                                    </div>
                                </div>
                                <div class="report-section-card-price">{{ $subscriptionPurchages->count() }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div class="report-section-card">
                                <div class="report-section-card-body">
                                    <div class="report-section-card-text">
                                        {{ __('total_subscriber') }}
                                    </div>
                                    <div class="report-section-card-image up-arrow-square-color">
                                        <img src="{{ asset('icons/users.svg') }}" alt="">
                                    </div>
                                </div>
                                <div class="report-section-card-price">{{ $users->count() }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div class="report-section-card">
                                <div class="report-section-card-body">
                                    <div class="report-section-card-text">
                                        {{ __('total_shop') }}
                                    </div>
                                    <div class="report-section-card-image dwon-arrow-square-color">
                                        <img src="{{ asset('icons/shop.svg') }}" alt="">
                                    </div>
                                </div>
                                <div class="report-section-card-price">{{ $shops->count() }}</div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div class="report-section-card">
                                <div class="report-section-card-body">
                                    <div class="report-section-card-text">
                                        {{ __('total_store') }}
                                    </div>
                                    <div class="report-section-card-image cup-arrow-square-color">
                                        <img src="{{ asset('icons/store.svg') }}" alt="">
                                    </div>
                                </div>
                                <div class="report-section-card-price">{{ $stores->count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="report-month-card">
                        <div class="report-month-card-text">{{ date('F') }} {{ date('Y') }}</div>
                        <div class="month-report-card">
                            <div class="monthly-purchase" style="width:25%;"></div>
                            <div class="monthly-revenue" style="width:55%;"></div>
                            <div class="monthly-expense" style="width:30%;"></div>
                        </div>
                        <div class="all-report-amount">
                            <div class="all-report-card">
                                <div class="all-report-card-text purchase-text-color">{{ __('subscription') }}</div>
                                @php
                                    $totalSubscriptionPrice = 0;
                                    foreach ($subscriptionPurchages as $key => $purchage) {
                                        $totalSubscriptionPrice += $purchage->subscription->price;
                                    }
                                @endphp
                                <div class="all-report-card-amount">{{ numberFormat($totalSubscriptionPrice) }}</div>
                            </div>
                            <div class="all-report-card">
                                <div class="all-report-card-text revenue-text-color">{{ __('failed_subscription') }}</div>
                                <div class="all-report-card-amount">
                                    {{ $subscriptionPurchages->where('status', 'Failed')->count() }}</div>
                            </div>
                            <div class="all-report-card">
                                <div class="all-report-card-text expense-text-color">{{ __('inactive_shop_request') }}
                                </div>
                                <div class="all-report-card-amount">{{ $shops->where('status', 'Inactive')->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-8">
                    <div class="graph-card mt-3">
                        <div class="graph-card-text">{{ __('cash_flow') }}</div>
                        <div id="payment"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="best-sale-monthly-card">
                        <div class="best-sale-monthly">
                            <div class="best-sale-monthly-text">{{ __('recent_shop') }} {{ date('F') }}</div>
                        </div>
                        <div class="table-responsive w-100">
                            <table class="table table-borderless table-responsive-md best-sell-table">
                                <tr class="best-sale-monthly-table-tr">
                                    <th class="border-r-0">{{ __('shop_details') }}</th>
                                    <th class="text-center">{{ __('status') }}</th>
                                </tr>
                                @foreach ($shops->take(5) as $key => $shop)
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <div class="best-sale-monthly-image">
                                                    <img src="{{ $shop->generalSettings?->logo?->file }}" width="150px"
                                                        alt="">
                                                </div>
                                                <div class="mt-2">{{ Str::limit($shop->name, 30, '...') }}</div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            @if ($shop->status->value == 'Active')
                                                <span class="transaction-status">{{ $shop->status->value }}</span>
                                            @else
                                                <span class="transaction-status-cradit">{{ $shop->status->value }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-lg-12">
                    <div class="best-sale-monthly-card">
                        <div class="best-sale-monthly">
                            <div class="best-sale-monthly-text">{{ __('recent_transaction') }}</div>
                        </div>
                        <div class="w-100 table-responsive">
                            <table class="table table-borderless table-responsive-md best-sell-table">
                                <tr class="best-sale-monthly-table-tr">
                                    <th class="not-exported">{{ __('sl') }}</th>
                                    <th>{{ __('shop_name') }}</th>
                                    <th>{{ __('subscription_title') }}</th>
                                    <th>{{ __('is_current') }}</th>
                                    <th>{{ __('payment_gateway') }}</th>
                                    <th>{{ __('payment_status') }}</th>
                                    <th>{{ __('expired_at') }}</th>
                                </tr>
                                <tbody>
                                    @foreach ($shopSubscriptions as $shopSubscription)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $shopSubscription->shop->name }}</td>
                                            <td>{{ $shopSubscription->subscription->title }}</td>
                                            <td>{{ $shopSubscription->is_current }}</td>
                                            <td>{{ $shopSubscription->payment_gateway }}</td>
                                            <td>{{ $shopSubscription->payment_status }}</td>
                                            <td>{{ dateFormat($shopSubscription->expired_at) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        var options = {
            series: [{
                name: "Subscription Sale",
                data: @json($formattedShopSubscriptions)
            }],

            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan'],
            }
        };

        var chart = new ApexCharts(document.querySelector("#payment"), options);
        chart.render();
    </script>
@endpush
