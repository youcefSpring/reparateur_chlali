<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png"
        href="{{ isset($general_settings->favicon->file) && $general_settings->favicon->file ? $general_settings->favicon->file : asset('/logo/small_logo.png') }}" />
    <title>
        {{ isset($general_settings->site_title) && $general_settings->site_title ? $general_settings->site_title : 'Ready POS' }}
        - {{ __('pos') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.min.css') }}" type="text/css">
    @vite('resources/css/app.css')
</head>
<style>
    :root {
        --theme-color: {{ $mainShop?->shopCategory?->primary_color ?? '#29aae1' }};
        --theme-secondary-color: {{ $mainShop?->shopCategory?->secondary_color ?? '#eaf7fc' }};
    }

    body {
        margin: 0;
        font-family: "Vazirmatn", sans-serif;
        font-size: 0.88rem;
        font-weight: 400;
        line-height: 1.5;
        color: #43475d;
        text-align: left;
        overflow-x: hidden;
    }

    .animated-element {
        color: #1f2937;
        animation: myAnimation 1s ease-in-out infinite;
        transition: 1s ease-in-out;
    }

    @keyframes myAnimation {
        0% {
            color: #d1d5db;
        }

        100% {
            color: #1f2937;
        }
    }

    @media (max-width:420px) {
        #dateTimeSection {
            display: none;
        }
    }

    @media (max-width:635px) {
        #categoryBrandSection {
            display: none;
        }

        #productListSection {
            display: none;
        }
    }

    .customScroll::-webkit-scrollbar {
        width: 5px !important;
    }

    .customScroll::-webkit-scrollbar-thumb {
        border-radius: 8px;
        background: #ddd;
    }

    tfoot {
        background-color: #f0f0f0;
        display: table-footer-group;
    }

    tfoot::before {
        content: '';
        position: absolute;
        z-index: -1;
        width: 100%;
        height: 100%;
        background: #f0f0f0;
    }

    .customActive {
        background-color: var(--theme-color) !important;
        color: #FFFFFF!important;
    }

    @media print {
        * {
            font-size: 12px;
            line-height: 20px;
        }

        body[data-pdfjsprinting] {
            overflow-y: visible;
            width: 100%;
            height: 100%;
        }

        td,
        th {
            padding: 5px 0;
        }

        @page {
            margin: 1.5cm 0.5cm 0.5cm;
            page-break-after: always;
            page-break-inside: avoid;
            page-break-before: avoid;
        }

        @page: first {
            margin-top: 0.5cm;
        }
    }

    .primary-text-color {
        color: var(--theme-color)
    }
    .primary-text-color-light {
        color: var(--theme-secondary-color)
    }
    .primary-bg-color {
        background: var(--theme-color)
    }
    .primary-bg-color-light {
        background: var(--theme-secondary-color)
    }
    .primary-border-color{
        border-color: var(--theme-color)
    }
    .primary-border-color-light{
        border-color: var(--theme-secondary-color)
    }
    .hover-primary-border-color:hover{
        border-color: var(--theme-secondary-color);
        background: var(--theme-secondary-color)
    }
    .hover-bg-primary-color-rgb{
        background: #70809082;
        
    }
</style>

<body>
    <div class="min-h-screen bg-blue-50">
        <!-- header -->
        <div class="print:hidden">
            <div class="h-[65px] px-8 bg-white shadow justify-between items-center flex gap-1 print:hidden">
                <div class="flex items-center gap-6">
                    <a href="{{ route('root') }}" class="w-32 md:w-40 transition">
                        <img src="{{ $general_settings->logo->file ?? asset('/logo/logo.png') }}" class="w-full" />
                    </a>
                </div>
                <div class="flex items-center gap-8">
                    <!-- time -->
                    <div id="dateTimeSection" class="text-sm sm:text-xl font-bold tracking-tight leading-tight">
                        <span id="date"></span> |
                        <span id="hours"></span><span class="animated-element sm:text-2xl leading-3">:</span><span
                            id="minutes"></span>
                    </div>
                    <a href="{{ route('root') }}"
                        class="hidden sm:flex rounded-full justify-center items-center cursor-pointer">
                        <img src="{{ asset('/icons/home.svg') }}"class="w-8 h-8" />
                    </a>
                    <a href="{{ route('sale.draft') }}"
                        class="hidden sm:flex rounded-full justify-center items-center cursor-pointer">
                        <img src="{{ asset('/icons/draft.svg') }}" class="w-8 h-8" />
                    </a>
                    {{-- <button type="button" id="wallet" class="hidden md:flex items-center gap-6 transition">
                        <img src="{{ asset('/icons/wallet.svg') }}" class="w-8 h-8" />
                    </button> --}}
                    <button type="button" id="zoom-in" class="hidden md:flex items-center gap-6 transition">
                        <img src="{{ asset('/icons/zoom-in.svg') }}" class="w-8 h-8" />
                    </button>
                    <button type="button" id="zoom-out" class="hidden md:flex items-center gap-6 transition">
                        <img src="{{ asset('/icons/zoom-out.svg') }}" class="w-8 h-8" />
                    </button>
                    <button type="button" id="logout"
                        class="grow-0 rounded-full flex justify-center items-center cursor-pointer">
                        <img src="{{ asset('/icons/logout.svg') }}" class="w-8 h-8" />
                    </button>
                </div>
            </div>
        </div>

        <div class="py-[8px] px-4 bg-blue-50 print:hidden">
            <div class="grid gap-x-2 gap-y-5 xl:gap-y-0 grid-cols-1 sm:grid-cols-3 lg:grid-cols-6 2xl:grid-cols-5">
                <!-- category -->
                <div class="col-span-1 bg-white p-2" id="categoryBrandSection">
                    <div class="grid grid-cols-1 xl:grid-cols-2 gap-2">
                        <div class="px-2 py-3 truncate bg-white text-center primary-text-color text-lg font-bold leading-[28.80px] mb-2 cursor-pointer category-brand border primary-border-color rounded customActive"
                            id="categoryBtn">
                            {{ __('categories') }}
                        </div>

                        <div class="px-2 py-3 bg-white text-center primary-text-color text-lg font-bold leading-[28.80px] mb-2 cursor-pointer category-brand border primary-border-color rounded"
                            id="brandBtn">
                            {{ __('brands') }}
                        </div>
                    </div>
                    <div class="md:max-h-[83vh] overflow-y-scroll customScroll">
                        <div class="grid grid-cols-1 xl:grid-cols-2 gap-2" id="categories"></div>
                        <div class="grid grid-cols-1 xl:grid-cols-2 gap-2" id="brands"></div>
                    </div>
                </div>

                <!-- Product -->
                <div class="col-span-1 sm:col-span-2 flex flex-col gap-2">
                    <div class="px-2 py-3 bg-white text-center primary-text-color text-lg font-bold leading-[28.80px]">
                        {{ __('products') }}
                    </div>
                    <div class="flex relative gap-2">
                        <input id="searchFeaturedProductInput" type="text"
                            placeholder="{{ __('scan_search_featured_product_by_name_or_code') }}"
                            class="form-input pl-11 px-4 py-3.5 bg-white focus:ring-2 focus:ring-sky-500 outline-none border-none w-full" />
                        <button class="bg-white px-4">
                            <img src="{{ asset('/icons/barcode.svg') }}" class="w-6 h-6" />
                        </button>
                        <div id="searchFeaturedProducts"
                            class="absolute w-full p-3 shadow-lg border border-slate-200 bg-white flex flex-col gap-2 z-10 max-h-96 overflow-y-auto">
                        </div>
                    </div>

                    <!-- product list -->
                    <div class="overflow-y-scroll customScroll md:max-h-[77vh]" id="productListSection">
                        <div id="featuredProducts"
                            class="grid grid-cols-1 gap-2 sm:grid-cols-3 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">
                        </div>
                    </div>
                </div>

                <!-- column three -->
                <div class="col-span-1 sm:col-span-3 lg:col-span-3 2xl:col-span-2">
                    <div class="relative">
                        <div class="flex gap-2 mb-2">
                            <div class="flex grow relative">
                                <img src="{{ asset('/icons/user-tie-solid.svg') }}"
                                    class="w-6 h-6 absolute top-2/4 transform -translate-y-2/4 left-3" />
                                <input id="searchCustomerInput" type="text"
                                    placeholder="{{ __('enter_customer_name_or_phone_number') }}"
                                    class="form-input pl-11 px-4 py-3.5 bg-white focus:ring-2 focus:ring-sky-500 outline-none border-none w-full"
                                    data-id="" />
                            </div>

                            <button class="h-13 bg-white px-4" id="addCustomerBtn">
                                <img src="{{ asset('/icons/plus.svg') }}" class="w-6 h-6" />
                            </button>
                        </div>

                        <div id="searchCustomers"
                            class="absolute w-full p-3 shadow-lg border border-slate-200 bg-white flex flex-col gap-2 z-10 max-h-96 overflow-y-auto">
                        </div>
                    </div>

                    <div class="lg:max-h-[64vh] lg:min-h-[300px] mt-2 overflow-y-scroll overflow-x-auto customScroll"
                        id="procusctTable">
                        <!-- product table -->
                        <table class="table-auto w-full">
                            <thead class="primary-bg-color-light sticky top-0">
                                <tr>
                                    <th class="p-2 text-left font-bold pl-4 primary-text-color text-base">
                                        {{ __('product') }}
                                    </th>
                                    <th class="p-2 text-center primary-text-color text-base font-bold">
                                        {{ __('discount') }}
                                    </th>
                                    <th class="p-2 text-center primary-text-color text-base font-bold">
                                        {{ __('tax') }}
                                    </th>
                                    <th class="p-2 text-center primary-text-color text-base font-bold">
                                        {{ __('price') }}
                                    </th>
                                    <th class="p-2 text-center primary-text-color text-base font-bold">
                                        {{ __('qty') }}
                                    </th>
                                    <th class="p-2 w-24 text-right primary-text-color text-base font-bold">
                                        {{ __('subtotal') }}
                                    </th>
                                    <th class="w-12"></th>
                                </tr>
                            </thead>
                            <tbody id="selectProducts">
                                @if ($sales)
                                    @foreach ($sales->productSales as $productSales)
                                        @php

                                            $tax = $productSales->product->tax->rate ?? 0;
                                            if ($tax > 0) {
                                                $tax =
                                                    ($productSales->net_unit_price *
                                                        $productSales->product->tax->rate) /
                                                    100;
                                            }
                                        @endphp
                                        <tr class="productSaleRow"
                                            id="productSaleRow_{{ $productSales->product->id }}"
                                            data-id="{{ $productSales->product->id }}">
                                            <td
                                                class="p-2 h-12 text-cyan-900 text-base font-normal border-b primary-border-color">
                                                <a href="javascript:void(0)"
                                                    class="truncate w-44 clip text-ellipsis productPriceCustomizeModal"
                                                    data-id="{{ $productSales->product->id }}">
                                                    {{ $productSales->product->name }}
                                                </a>
                                                <!-- Product price customization Modal Start -->
                                                <div class="fixed z-10 inset-0 invisible overflow-y-auto"
                                                    aria-labelledby="modal-title" role="dialog" aria-modal="true"
                                                    id="productPriceCustomizationModal_{{ $productSales->product->id }}">
                                                    <div
                                                        class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                                                            aria-hidden="true"></div>
                                                        <span
                                                            class="hidden sm:inline-block sm:align-middle sm:h-screen"
                                                            aria-hidden="true">​</span>
                                                        <div
                                                            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                                <div class="sm:flex sm:items-start">
                                                                    <div class="mt-3 text-center sm:mt-0 sm:text-left">
                                                                        <h3 class="text-lg leading-6 font-medium text-gray-900"
                                                                            id="modal-title">
                                                                            {{ __('product_price_customization') }}
                                                                        </h3>
                                                                        <div class="mt-2">
                                                                            <div
                                                                                class="grid gap-4 md:grid-cols-2 mt-2 w-full">
                                                                                <div class="mt-3">
                                                                                    <label class="text-slate-500"
                                                                                        for="name">{{ __('product_name') }}
                                                                                    </label>
                                                                                    <input type="text"
                                                                                        value="{{ $productSales->product->name }}"
                                                                                        disabled
                                                                                        id="product_name_{{ $productSales->product->id }}"
                                                                                        placeholder="{{ __('enter_your_product_name') }}"
                                                                                        class="border-slate-200 bg-slate-50 rounded-lg placeholder:text-slate-400 text-slate-400 focus:ring-slate-300 focus:border-transparent focus:ring-1 w-full mt-2" />
                                                                                </div>
                                                                                <div class="mt-3">
                                                                                    <label class="text-slate-500"
                                                                                        for="product_price">{{ __('product_price') }}
                                                                                        <span
                                                                                            class="text-red-500">*</span></label>
                                                                                    <input type="text"
                                                                                        value="{{ $productSales->net_unit_price }}"
                                                                                        id="product_price_{{ $productSales->product->id }}"
                                                                                        data-tax-rate="{{ $productSales->product->tax->rate ?? 0 }}"
                                                                                        name="price"
                                                                                        class="border-slate-200 bg-slate-50 rounded-lg placeholder:text-slate-400 focus:ring-slate-300 focus:border-transparent focus:ring-1 w-full mt-2"
                                                                                        placeholder="{{ __('enter_your_product_price') }}" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                                <button type="button"
                                                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm submitProductPriceCustomizationModal"
                                                                    data-id="{{ $productSales->product->id }}">
                                                                    {{ __('update_and_save') }}
                                                                </button>
                                                                <button type="button"
                                                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm closeProductPriceCustomizationModal"
                                                                    data-id="{{ $productSales->product->id }}">
                                                                    {{ __('cancel') }}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Product price customization Modal End -->
                                            </td>
                                            <td
                                                class="p-2 h-12 text-center text-cyan-900 text-base font-normal border-b primary-border-color">
                                                {{ numberFormat($productSales->product->discount ?? 0) }}
                                            </td>
                                            <td class="p-2 h-12 text-center text-cyan-900 text-base font-normal border-b primary-border-color"
                                                id="productTax_{{ $productSales->product->id }}">
                                                {{ numberFormat($tax) }}
                                            </td>
                                            <td class="p-2 h-12 text-center text-cyan-900 text-base font-normal border-b primary-border-color productPrice"
                                                data-price="{{ $productSales->net_unit_price }}"
                                                id="productPrice_{{ $productSales->product->id }}">
                                                {{ numberFormat($productSales->net_unit_price) }}
                                            </td>
                                            <td
                                                class="p-2 h-12 text-center text-cyan-900 text-base font-normal border-b primary-border-color">
                                                <div class="flex justify-center items-center gap-2">
                                                    <button
                                                        class="w-4 h-4 primary-bg-color rounded-sm flex justify-center items-center"
                                                        onclick="minusProduct({{ $productSales->product->id }})">
                                                        <img src="{{ asset('/icons/minus.svg') }}" class="w-4 h-4" />
                                                    </button>
                                                    <span
                                                        class="text-cyan-900 text-base font-normal tracking-tight productQty"
                                                        id="productQty_{{ $productSales->product->id }}">
                                                        {{ $productSales->qty }}
                                                    </span>
                                                    <button
                                                        class="w-4 h-4 primary-bg-color rounded-sm flex justify-center items-center"
                                                        onclick="addProduct({{ $productSales->product->id }}, {{ $productSales->product->qty }})">
                                                        <img src="{{ asset('/icons/plus.svg') }}" class="w-4 h-4" />
                                                    </button>
                                                </div>
                                            </td>
                                            <td class="p-2 h-12 w-24 text-right text-cyan-900 text-base font-normal border-b primary-border-color productSubtotal"
                                                id="productSubtotal_{{ $productSales->product->id }}"
                                                data-subtotal="{{ $productSales->net_unit_price + $tax }}">
                                                {{ numberFormat(($productSales->net_unit_price + $tax) * $productSales->qty) }}
                                            </td>
                                            <td class="w-12 h-12 border-b primary-border-color text-center">
                                                <div class="p-0 m-auto flex w-5 h-5 bg-red-400 rounded-full justify-center items-center cursor-pointer"
                                                    onclick="removeProductFromCart({{ $productSales->product->id }})">
                                                    <img src="{{ asset('/icons/remove.svg') }}" class="w-2 h-2" />
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif

                                <tr id="noProducts" @if ($sales) style="display: none;" @endif>
                                    <td colspan="7" class="h-12 border-b primary-border-color text-center">
                                        {{ __('no_products_available_in_the_list') }}
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot class="sticky bottom-0 bg-white">
                                <tr>
                                    <td colspan="5"
                                        class="p-2 h-12 primary-bg-color-light border-b primary-border-color-light text-cyan-900 text-base font-medium">
                                        {{ __('total_products') }}:
                                    </td>
                                    <td
                                        class="text-right p-2 h-12 w-24 primary-bg-color-light border-b primary-border-color-light text-cyan-900 text-base font-medium">
                                        <span id="totalProduct">{{ $sales->item ?? 0 }}</span>(<span
                                            id="totalItem">{{ $sales->total_qty ?? 0 }}</span>)
                                    </td>
                                    <td class="p-2 w-12 h-12 primary-bg-color-light border-b primary-border-color-light"></td>
                                </tr>

                                <tr>
                                    <td colspan="5"
                                        class="p-2 h-12 primary-bg-color-light border-b primary-border-color-light text-cyan-900 text-base font-medium">
                                        {{ __('total_amount') }}:
                                    </td>
                                    <td
                                        class="text-right p-2 h-12 primary-bg-color-light border-b primary-border-color-light text-cyan-900 text-base font-medium">
                                        <span id="totalAmount">{{ numberFormat($sales->total_price ?? 0) }}</span>
                                    </td>
                                    <td class="p-2 w-12 h-12 primary-bg-color-light border-b primary-border-color-light"></td>
                                </tr>

                                <tr>
                                    <td colspan="5"
                                        class="p-2 h-12 primary-bg-color-light border-b primary-border-color-light text-cyan-900 text-base font-medium">
                                        {{ __('discount') }}
                                    </td>
                                    <td
                                        class="text-right p-2 h-12 primary-bg-color-light border-b primary-border-color-light text-rose-400 text-base font-medium">
                                        -
                                        <span
                                            id="totalDiscount">{{ numberFormat($sales->order_discount ?? 0) }}</span>
                                    </td>
                                    <td class="p-2 w-12 h-12 primary-bg-color-light border-b primary-border-color-light"></td>
                                </tr>

                                <tr>
                                    <td class="p-2 h-12 primary-bg-color-light border-b primary-border-color-light text-cyan-900 text-base font-medium"
                                        colspan="5">
                                        <div class="flex gap-2">
                                            <span>{{ __('coupon') }}</span>

                                            <div class="relative">
                                                <input type="text"
                                                    class="w-[198.88px] h-8 pl-2 pr-1 py-1 primary-bg-color-light rounded-[5px] text-gray-500 text-base font-normal border-slate-300 outline-none"
                                                    placeholder="Coupon code.." id="couponCodeInput" />
                                                <button
                                                    class="absolute right-1 top-2/4 -translate-y-2/4 bg-green-500 rounded-[3px] w-6 h-6 flex justify-center items-center"
                                                    id="applyCouponBtn">
                                                    <img src="{{ asset('/icons/checked.svg') }}" class="w-6 h-6">
                                                </button>
                                                <button
                                                    class="absolute right-1 top-2/4 -translate-y-2/4 bg-red-100 w-6 h-6 flex justify-center items-center"
                                                    id="removeCouponBtn">
                                                    <img src="{{ asset('/icons/removed.svg') }}"
                                                        class="w-4 h-4 p-[2px]">
                                                </button>
                                            </div>

                                            <button
                                                class="w-8 h-8 rounded-md bg-blue-50 cursor-pointer flex justify-center items-center"
                                                id="addCouponBtn">
                                                <img src="{{ asset('/icons/plus.svg') }}" class="w-6 h-6" />
                                            </button>
                                        </div>
                                    </td>
                                    <td class="p-2 h-12 primary-bg-color-light border-b primary-border-color-light text-cyan-900 text-base font-medium text-right discount"
                                        data-coupon-id="">{{ numberFormat($sales->coupon_discount ?? 0) }}</td>
                                    <td class="p-2 w-12 h-12 primary-bg-color-light border-b primary-border-color-light"></td>
                                </tr>
                                <tr>
                                    <td class="primary-bg-color p-2 pr-0" colspan="5">
                                        <div class="w-full justify-end inline-flex text-blue-50 text-base font-bold">
                                            <span>{{ __('grand_total') }}:</span>
                                        </div>
                                    </td>
                                    <td class="primary-bg-color p-2 text-right">
                                        <div class="text-blue-50 text-base font-bold"><span id="totalGrand"
                                                data-grand-price="{{ $sales->grand_total ?? 0 }}">{{ numberFormat($sales->grand_total ?? 0) }}</span>
                                        </div>
                                    </td>
                                    <td class="primary-bg-color p-2 w-12 h-12"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Payment Method -->
                    <div class="flex gap-2 flex-wrap mt-3">
                        <div class="grow relative">
                            <input type="radio" name="payment" value="Cash" id="cash" class="peer sr-only"
                                checked />
                            <label for="cash"
                                class="flex justify-center items-center gap-2 p-2 text-base font-semibold leading-relaxed text-teal-400 primary-bg-color- h-12 border-2 border-transparent peer-checked:primary-boder-color cursor-pointer">
                                <img src="{{ asset('/icons/cash.svg') }}" alt="" />
                                <span>{{ __('cash') }}</span>
                            </label>
                        </div>

                        <div class="grow relative">
                            <input type="radio" name="payment" id="card" value="Card"
                                class="peer sr-only" />
                            <label for="card"
                                class="flex justify-center items-center gap-2 p-2 text-base font-semibold leading-relaxed text-blue-500 bg-blue-100 h-12 border-2 border-transparent peer-checked:border-blue-500 cursor-pointer peer-disabled:text-blue-300 peer-disabled:cursor-not-allowed">
                                <img src="{{ asset('/icons/card.svg') }}" alt="" />
                                <span>{{ __('card') }}</span>
                            </label>
                        </div>

                        <div class="grow relative">
                            <input type="radio" name="payment" id="paypal" value="PayPal"
                                class="peer sr-only" />
                            <label for="paypal"
                                class="flex justify-center items-center gap-2 p-2 text-base font-semibold leading-relaxed bg-slate-200 text-indigo-900 h-12 border-2 border-transparent peer-checked:border-indigo-900 cursor-pointer peer-disabled:text-indigo-300 peer-disabled:cursor-not-allowed">
                                <img src="{{ asset('/icons/paypal.svg') }}" alt="" />
                                <span>{{ __('paypal') }}</span>
                            </label>
                        </div>

                        <div class="grow relative">
                            <input type="radio" name="payment" id="Cheque" value="Cheque"
                                class="peer sr-only" />
                            <label for="Cheque"
                                class="flex justify-center items-center gap-2 p-2 text-base font-semibold leading-relaxed bg-red-100 text-red-400 h-12 border-2 border-transparent peer-checked:border-red-400 cursor-pointer peer-disabled:text-red-300 peer-disabled:cursor-not-allowed">
                                <img src="{{ asset('/icons/cheque.svg') }}" alt="" />
                                <span>{{ __('cheque') }}</span>
                            </label>
                        </div>

                        {{-- <div class="grow relative">
                            <input type="radio" name="payment" id="Gift" value="Gift Card"
                                class="peer sr-only" disabled />
                            <label for="Gift"
                                class="flex justify-center items-center gap-2 p-2 text-base font-semibold leading-relaxed bg-violet-100 text-violet-700 h-12 border-2 border-transparent peer-checked:border-violet-700 cursor-pointer peer-disabled:text-violet-300 peer-disabled:cursor-not-allowed">
                                <img src="{{ asset('/icons/gift.svg') }}" alt="" />
                                <span>Gift Card</span>
                            </label>
                        </div> --}}
                    </div>

                    <!-- action button -->
                    <div class="flex flex-wrap gap-2 mt-4">
                        <button
                            class="h-12 px-4 text-base font-medium leading-tight tracking-tight grow text-red-600 bg-rose-100"
                            onclick="cancelSale()">
                            {{ __('cancel') }}
                        </button>
                        <button
                            class="h-12 px-4 text-base font-medium leading-tight tracking-tight grow text-blue-50 bg-amber-300"
                            onclick="complate('Draft')">
                            {{ __('draft') }}
                        </button>
                        <button
                            class="h-12 px-4 text-base font-medium leading-tight tracking-tight grow text-blue-50 primary-bg-color"
                            onclick="complate('Sales')">
                            {{ __('save_and_complate') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- logout modal -->
    <div class="fixed z-10 inset-0 invisible overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true" id="logoutModal">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                {{ __('logout_account') }}
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    {{ __('are_you_sure_you_want_to_logout_your_account') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
                        id="confirmLogout">
                        {{ __('logout') }}
                    </button>
                    <button type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                        id="closeModalLogout">
                        {{ __('close') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Store Wallet Modal -->
    <div class="fixed z-10 inset-0 invisible overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true" id="storeWalletModal">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                {{ __('') }}Deposit POS Cash
                            </h3>

                            <div class="mt-2">
                                <div class="flex justify-between flex-wrap gap-2 bg-slate-100 p-3 rounded-lg">
                                    <div class="text-lg">
                                        <span class="text-slate-500">Available Amount :
                                        </span>
                                        <span class="primary-text-color font-semibold">$ 100.00</span>
                                    </div>
                                    <div class="text-lg">
                                        <span class="text-slate-500">Today's Sale :
                                        </span>
                                        <span class="primary-text-color font-semibold">$ 100.00</span>
                                    </div>
                                </div>
                                <div class="grid gap-4 md:grid-cols-2 mt-2 w-full">
                                    <div class="mt-3">
                                        <label class="text-slate-500" for="payment_method">Payment Method<span
                                                class="text-red-500">*</span></label>
                                        <select id="payment_method"
                                            class="border-slate-200 bg-slate-50 rounded-lg text-slate-400 focus:ring-slate-300 focus:border-transparent focus:ring-1 w-full mt-2">
                                            <option value="Cash">
                                                Cash
                                            </option>
                                            <option value="Bank">
                                                Bank
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mt-3">
                                        <label class="text-slate-500" for="account_id">Account<span
                                                class="text-red-500">*</span></label>
                                        <select id="account_id"
                                            class="border-slate-200 bg-slate-50 rounded-lg text-slate-400 focus:ring-slate-300 focus:border-transparent focus:ring-1 w-full mt-2">
                                            <option value="" selected disabled>
                                                Select a account
                                            </option>
                                            <option>account.name</option>
                                        </select>
                                    </div>
                                    <div class="mt-3">
                                        <label class="text-slate-500" for="amount">Amount
                                            <span class="text-red-500">*</span></label>
                                        <input type="text" id="amount"
                                            class="border-slate-200 bg-slate-50 rounded-lg placeholder:text-slate-400 focus:ring-slate-300 focus:border-transparent focus:ring-1 w-full mt-2"
                                            placeholder="Enter amount" />
                                    </div>
                                </div>
                                <div class="grid gap-4 md:grid-cols-2 mt-2 w-full">
                                    <div class="mt-3">
                                        <label class="text-slate-500" for="purpose">Purpose</label>
                                        <input type="text" id="purpose"
                                            class="border-slate-200 bg-slate-50 rounded-lg placeholder:text-slate-400 focus:ring-slate-300 focus:border-transparent focus:ring-1 w-full mt-2"
                                            placeholder="Enter purpose" />
                                    </div>
                                    <div class="mt-3">
                                        <label class="text-slate-500" for="name">Date
                                            <span class="text-red-500">*</span></label>
                                        <input type="date" id="date"
                                            class="border-slate-200 bg-slate-50 rounded-lg placeholder:text-slate-400 text-slate-400 focus:ring-slate-300 focus:border-transparent focus:ring-1 w-full mt-2" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Submit
                    </button>
                    <button type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                        id="closeModalWallet">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Customer Add Modal -->
    <div class="fixed z-10 inset-0 invisible overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true" id="customerAddModal">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                {{ __('add_customer') }}
                            </h3>

                            <div class="grid md:grid-cols-2 gap-4 py-3 w-full">
                                <div>
                                    <label class="text-slate-500"
                                        for="customer_group_id">{{ __('customer_group') }}</label>
                                    <select id="customer_group_id"
                                        class="border-slate-200 bg-slate-50 rounded-lg text-slate-400 focus:ring-slate-300 focus:border-transparent focus:ring-1 w-full mt-2">
                                        <option value="" selected disabled>
                                            {{ __('select_a_option') }}
                                        </option>
                                    </select>
                                </div>
                                <div>
                                    <label class="text-slate-500" for="name">{{ __('name') }}<span
                                            class="text-red-500">*</span></label>
                                    <input type="text" id="name"
                                        class="border-slate-200 bg-slate-50 rounded-lg placeholder:text-slate-400 focus:ring-slate-300 focus:border-transparent focus:ring-1 w-full mt-2"
                                        placeholder="{{ __('enter_your_customer_name') }}">
                                </div>
                                <div>
                                    <label class="text-slate-500" for="phone_number">{{ __('phone_number') }}<span
                                            class="text-red-500">*</span></label>
                                    <input type="number" id="phone_number"
                                        class="border-slate-200 bg-slate-50 rounded-lg placeholder:text-slate-400 focus:ring-slate-300 focus:border-transparent focus:ring-1 w-full mt-2"
                                        placeholder="{{ __('enter_your_customer_phone_number') }}" />
                                </div>
                                <div>
                                    <label class="text-slate-500" for="email">{{ __('email') }}</label>
                                    <input type="email" id="email"
                                        class="border-slate-200 bg-slate-50 rounded-lg placeholder:text-slate-400 focus:ring-slate-300 focus:border-transparent focus:ring-1 w-full mt-2"
                                        placeholder="{{ __('enter_your_customer_email_address') }}" />
                                </div>
                                <div>
                                    <label class="text-slate-500" for="password">{{ __('password') }}</label>
                                    <input type="password" id="password"
                                        placeholder="{{ __('enter_your_customer_password') }}"
                                        class="border-slate-200 bg-slate-50 rounded-lg placeholder:text-slate-400 focus:ring-slate-300 focus:border-transparent focus:ring-1 w-full mt-2">
                                </div>
                                <div>
                                    <label class="text-slate-500" for="tax_number">{{ __('tax_number') }}</label>
                                    <input type="text" id="tax_number"
                                        class="border-slate-200 bg-slate-50 rounded-lg placeholder:text-slate-400 focus:ring-slate-300 focus:border-transparent focus:ring-1 w-full mt-2"
                                        placeholder="{{ __('enter_your_customer_tax_number') }}" />
                                </div>
                                <div class="col-span-2">
                                    <label class="text-slate-500" for="address">{{ __('address') }}</label>
                                    <input type="text" id="address"
                                        class="border-slate-200 bg-slate-50 rounded-lg placeholder:text-slate-400 focus:ring-slate-300 focus:border-transparent focus:ring-1 w-full mt-2"
                                        placeholder="{{ __('enter_your_customer_address') }}" />
                                </div>
                                <div>
                                    <label class="text-slate-500" for="country">{{ __('country') }}</label>
                                    <input type="text" id="country"
                                        class="border-slate-200 bg-slate-50 rounded-lg placeholder:text-slate-400 focus:ring-slate-300 focus:border-transparent focus:ring-1 w-full mt-2"
                                        placeholder="{{ __('enter_your_customer_country') }}" />
                                </div>
                                <div>
                                    <label class="text-slate-500" for="city">{{ __('city') }}</label>
                                    <input type="text" id="city"
                                        class="border-slate-200 bg-slate-50 rounded-lg placeholder:text-slate-400 focus:ring-slate-300 focus:border-transparent focus:ring-1 w-full mt-2"
                                        placeholder="{{ __('enter_your_customer_city') }}" />
                                </div>
                                <div>
                                    <label class="text-slate-500" for="state">{{ __('state') }}</label>
                                    <input type="text" id="state"
                                        class="border-slate-200 bg-slate-50 rounded-lg placeholder:text-slate-400 focus:ring-slate-300 focus:border-transparent focus:ring-1 w-full mt-2"
                                        placeholder="{{ __('enter_your_customer_state') }}" />
                                </div>
                                <div>
                                    <label class="text-slate-500" for="post_code">{{ __('post_code') }}</label>
                                    <input type="text" id="post_code"
                                        class="border-slate-200 bg-slate-50 rounded-lg placeholder:text-slate-400 focus:ring-slate-300 focus:border-transparent focus:ring-1 w-full mt-2"
                                        placeholder="{{ __('enter_your_customer_post_code') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" id="submitCustomer"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        {{ __('submit') }}
                    </button>
                    <button type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                        id="closeModalCustomer">
                        {{ __('close') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="barcodeDigits">
    <script src="{{ asset('assets/scripts/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('assets/scripts/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/scripts/sweetalert_modify.js') }}"></script>
    <!-- Currency JS -->
    <script>
        function currencySymbol(number) {
            var symbol = (settings().currency && settings().currency.symbol) ? settings().currency.symbol : '$';

            if (settings().currency_position && settings().currency_position === "Prefix") {
                return symbol + ' ' + Number(number).toFixed(2);
            }

            return Number(number).toFixed(2) + ' ' + symbol;
        }

        function settings() {
            return {!! json_encode($general_settings) !!};
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#zoom-out').hide();
            $('#logout').on('click', function(e) {
                $('#logoutModal').removeClass('invisible');
            });
            $('#closeModalLogout').on('click', function(e) {
                $('#logoutModal').addClass('invisible');
            });
            $('#confirmLogout').on('click', function(e) {
                window.location.href = '/signout';
            });
            $('#wallet').on('click', function(e) {
                $('#storeWalletModal').removeClass('invisible');
            });
            $('#closeModalWallet').on('click', function(e) {
                $('#storeWalletModal').addClass('invisible');
            });
            $('#zoom-in').on('click', function(e) {
                $('#zoom-in').hide();
                $('#zoom-out').show();
                var elem = document.documentElement; // Fullscreen the entire document
                if (elem.requestFullscreen) {
                    elem.requestFullscreen();
                } else if (elem.mozRequestFullScreen) {
                    /* Firefox */
                    elem.mozRequestFullScreen();
                } else if (elem.webkitRequestFullscreen) {
                    /* Chrome, Safari & Opera */
                    elem.webkitRequestFullscreen();
                } else if (elem.msRequestFullscreen) {
                    /* IE/Edge */
                    elem.msRequestFullscreen();
                }
            });
            $('#zoom-out').on('click', function(e) {
                $('#zoom-in').show();
                $('#zoom-out').hide();
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.webkitExitFullscreen) {
                    /* Safari */
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) {
                    /* IE11 */
                    document.msExitFullscreen();
                }
            });

            function updateTime() {
                var now = new Date();
                var hours = ('0' + now.getHours()).slice(-2);
                var minutes = ('0' + now.getMinutes()).slice(-2);
                var date = now.getDate();
                var month = now.toLocaleString('default', {
                    month: 'short'
                });
                var year = now.getFullYear();

                $('#date').text(date + ' ' + month + ', ' + year);
                $('#hours').text(hours);
                $('#minutes').text(minutes);
            }

            updateTime();
            setInterval(updateTime, 1000);

            $('#searchFeaturedProducts').hide();
            $('#searchProducts').hide();
            $('#searchCustomers').hide();
            $('#couponCodeInput').hide();
            $('#removeCouponBtn').hide();
            $('#applyCouponBtn').hide();
            $.ajax({
                url: '/pos/data',
                type: 'GET',
                success: function(response) {
                    $('#barcodeDigits').val(response.data.barcodeDigits);
                    var categories = $('#categories');
                    var brands = $('#brands');
                    var featuredProducts = $('#featuredProducts');
                    var customerGroupId = $('#customer_group_id');
                    response.data.customerGroups.forEach(function(item) {
                        customerGroupId.append(
                            `<option value="${item.id}">${item.name}</option>`);
                    });
                    response.data.categories.forEach(function(item) {
                        categories.append(`<div class="relative category-select" data-id="${item.id}">
                                    <input type="radio" name="category" class="peer sr-only"/>
                                    <label class="w-full p-2 bg-slate-50 justify-center items-center gap-2 flex flex-wrap m-0 border-2 border-slate-50 cursor-pointer hover:primary-border-color-light hover-primary-border-color">
                                        <div class="items-center flex overflow-hidden">
                                            <img class="rounded-[7px] max-h-32" src="${item.thumbnail}" />
                                        </div>
                                        <span class="text-cyan-900 text-base font-medium leading-tight w-[150px] text-center">
                                            ${item.name}
                                        </span>
                                    </label>
                                </div>`);
                    });
                    response.data.brands.forEach(function(item) {
                        brands.append(`<div class="relative brand-select" data-id="${item.id}">
                                    <input type="radio" name="category" class="peer sr-only"/>
                                    <label class="w-full p-2 bg-slate-50 justify-center items-center gap-2 flex flex-wrap m-0 border-2 border-slate-50 cursor-pointer hover:primary-border-color-light hover-primary-border-color">
                                        <div class="items-center flex overflow-hidden">
                                            <img class="rounded-[7px] max-h-32" src="${item.thumbnail}" />
                                        </div>
                                        <span class="text-cyan-900 text-base font-medium leading-tight w-[150px] text-center">
                                            ${item.name}
                                        </span>
                                    </label>
                                </div>`);
                    });
                    response.data.featuredProducts.forEach(function(item) {
                        let stock = `<div class="bg-slate-200 py-1 px-2 rounded-full text-sm text-red-600">
                                Out of Stock
                            </div>`;
                        if (item.stock > 0) {
                            stock = `<div class="flex justify-center items-center gap-4 grow">
                                <button class="w-8 h-8 bg-white rounded-[5px] flex justify-center items-center" onclick="minusProduct(${item.id})">
                                    <img src="{{ asset('/icons/minus.svg') }}" class="w-4 h-4" />
                                </button>
                                <span class="text-white text-lg font-semibold leading-snug tracking-tight" id="featuredProducts_${item.id}">0</span>
                                <button class="w-8 h-8 bg-white rounded-[5px] flex justify-center items-center" onclick="addProduct(${item.id}, ${item.stock})">
                                    <img src="{{ asset('/icons/plus.svg') }}" class="w-4 h-4" />
                                </button>
                            </div>`;
                        }
                        featuredProducts.append(`<div class="group p-2 bg-white flex-col justify-center items-center gap-1 flex relative border-2" id="featuredProductsborder_${item.id}" data-id="${item.id}">
                                            <div class="items-center flex overflow-hidden">
                                                <img class="rounded-[7px] max-h-36" src="${item.thumbnail}" />
                                            </div>
                                            <div class="flex-col justify-center items-center gap-0.5 flex w-full pt-1">
                                                <div class="text-cyan-900 text-xs font-bold leading-tight truncate w-full text-center">
                                                    ${item.name}
                                                </div>
                                                <div class="text-slate-500 text-[10px] font-normal leading-3">
                                                    ${item.code}
                                                </div>
                                                <div class="text-cyan-900 text-xs font-medium leading-[14.40px]">
                                                    In Stock: ${item.stock}
                                                </div>
                                            </div>

                                            <div class="hover-bg-primary-color-rgb h-full w-full group-hover:flex transition justify-center items-center absolute hidden" id="featuredProductsborderhover_${item.id}">
                                                ${stock}
                                            </div>
                                        </div>`);
                    });
                    selectedProducts();
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                }
            });
            $('#searchFeaturedProductInput').on('keyup', function(e) {
                $('#searchFeaturedProducts').show().html('');
                var value = $(this).val();
                const barcodeDigits = $('#barcodeDigits').val();
                $.ajax({
                    url: '/product/search',
                    type: 'GET',
                    data: {
                        search: value
                    },
                    success: function(response) {
                        let html = `<div class="border border-slate-200 bg-slate-50 rounded p-2 cursor-pointer hover:bg-slate-200"> 
                                        {{ __('no_result_found') }}
                                    </div>`;
                        $.each(response.data.products, function(index, item) {
                            html += `<div class="border border-slate-200 bg-slate-50 rounded p-2 cursor-pointer hover:bg-slate-200 product-select" data-id="${item.id}" data-stock="${item.qty}"> 
                                ${item.name}
                            </div>`;
                        });
                        $('#searchFeaturedProducts').html(html);
                        // Automatic click if search value is one
                        if (value.length === Number(barcodeDigits)) {
                            // prevent duplicate request
                            if (!$('#searchFeaturedProducts').data('request-sent')) {
                                $('#searchFeaturedProducts').data('request-sent', true);
                                $('.product-select').first().trigger('click');
                            }
                        } else {
                            $('#searchFeaturedProducts').removeData('request-sent');
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error(xhr.responseText);
                    }
                });
            });
            $('#searchCustomerInput').on('keyup', function(e) {
                $('#searchCustomers').show();
                var value = $(this).val();
                $.ajax({
                    url: '/customer/search',
                    type: 'GET',
                    data: {
                        search: value
                    },
                    success: function(response) {
                        var searchCustomers = $('#searchCustomers');
                        response.data.customers.forEach(function(item) {
                            searchCustomers.append(`<div class="border border-slate-200 bg-slate-50 rounded p-2 cursor-pointer hover:bg-slate-200 customer-select" data-name="${item.name}" data-id="${item.id}">
                                                ${item.name}
                                            </div>`);
                        });
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error(xhr.responseText);
                    }
                });
            });
            $('body').on('click', function(e) {
                $('#searchFeaturedProductInput').val('');
                $('#searchFeaturedProducts').hide();
                $('#searchProducts').hide();
                $('#searchCustomers').hide();
            });
            $(document).on('click', '.category-select', function(e) {
                var id = $(this).attr('data-id');
                $.ajax({
                    url: '/product/search',
                    type: 'GET',
                    data: {
                        category_id: id
                    },
                    success: function(response) {
                        var featuredProducts = $('#featuredProducts');
                        featuredProducts.children().remove();

                        response.data.categoryProducts.forEach(function(item) {
                            let stock = `<div class="bg-slate-200 py-1 px-2 rounded-full text-sm text-red-600">
                                Out of Stock
                            </div>`;
                            if (item.stock > 0) {
                                stock = `<div class="flex justify-center items-center gap-4 grow">
                                <button class="w-8 h-8 bg-white rounded-[5px] flex justify-center items-center" onclick="minusProduct(${item.id})">
                                    <img src="{{ asset('/icons/minus.svg') }}" class="w-4 h-4" />
                                </button>
                                <span class="text-white text-lg font-semibold leading-snug tracking-tight" id="featuredProducts_${item.id}">0</span>
                                <button class="w-8 h-8 bg-white rounded-[5px] flex justify-center items-center" onclick="addProduct(${item.id}, ${item.stock})">
                                    <img src="{{ asset('/icons/plus.svg') }}" class="w-4 h-4" />
                                </button>
                            </div>`;
                            }
                            featuredProducts.append(`<div class="group p-2 bg-white flex-col justify-center items-center gap-1 flex relative border-2" id="featuredProductsborder_${item.id}" data-id="${item.id}">
                                            <div class="items-center flex overflow-hidden">
                                                <img class="rounded-[7px] max-h-36" src="${item.thumbnail}" />
                                            </div>
                                            <div class="flex-col justify-center items-center gap-0.5 flex w-full pt-1">
                                                <div class="text-cyan-900 text-xs font-bold leading-tight truncate w-full text-center">
                                                    ${item.name}
                                                </div>
                                                <div class="text-slate-500 text-[10px] font-normal leading-3">
                                                    ${item.code}
                                                </div>
                                                <div class="text-cyan-900 text-xs font-medium leading-[14.40px]">
                                                    In Stock: ${item.stock}
                                                </div>
                                            </div>

                                            <div class="hover-bg-primary-color-rgb h-full w-full group-hover:flex transition justify-center items-center absolute hidden" id="featuredProductsborderhover_${item.id}">
                                                ${stock}
                                            </div>
                                        </div>`);
                        });
                        selectedProducts();
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error(xhr.responseText);
                    }
                });
            });
            $('#categoryBtn').on('click', function(e) {
                $(this).addClass('customActive');
                $('#brandBtn').removeClass('customActive');
                $('#categories').show();
                $('#brands').hide();

                selectedProducts();
            });
            $('#brandBtn').on('click', function(e) {
                $(this).addClass('customActive');
                $('#categoryBtn').removeClass('customActive');
                $('#brands').show();
                $('#categories').hide();

                selectedProducts();
            });
            $(document).on('click', '.brand-select', function(e) {
                var id = $(this).attr('data-id');
                $.ajax({
                    url: '/product/search',
                    type: 'GET',
                    data: {
                        brand_id: id
                    },
                    success: function(response) {
                        var featuredProducts = $('#featuredProducts');
                        featuredProducts.children().remove();

                        response.data.brandProducts.forEach(function(item) {
                            let stock = `<div class="bg-slate-200 py-1 px-2 rounded-full text-sm text-red-600">
                                Out of Stock
                            </div>`;
                            if (item.stock > 0) {
                                stock = `<div class="flex justify-center items-center gap-4 grow">
                                <button class="w-8 h-8 bg-white rounded-[5px] flex justify-center items-center" onclick="minusProduct(${item.id})">
                                    <img src="{{ asset('/icons/minus.svg') }}" class="w-4 h-4" />
                                </button>
                                <span class="text-white text-lg font-semibold leading-snug tracking-tight" id="featuredProducts_${item.id}">0</span>
                                <button class="w-8 h-8 bg-white rounded-[5px] flex justify-center items-center" onclick="addProduct(${item.id}, ${item.stock})">
                                    <img src="{{ asset('/icons/plus.svg') }}" class="w-4 h-4" />
                                </button>
                            </div>`;
                            }
                            featuredProducts.append(`<div class="group p-2 bg-white flex-col justify-center items-center gap-1 flex relative border-2" id="featuredProductsborder_${item.id}" data-id="${item.id}">
                                            <div class="items-center flex overflow-hidden">
                                                <img class="rounded-[7px] max-h-36" src="${item.thumbnail}" />
                                            </div>
                                            <div class="flex-col justify-center items-center gap-0.5 flex w-full pt-1">
                                                <div class="text-cyan-900 text-xs font-bold leading-tight truncate w-full text-center">
                                                    ${item.name}
                                                </div>
                                                <div class="text-slate-500 text-[10px] font-normal leading-3">
                                                    ${item.code}
                                                </div>
                                                <div class="text-cyan-900 text-xs font-medium leading-[14.40px]">
                                                    In Stock: ${item.stock}
                                                </div>
                                            </div>

                                            <div class="hover-bg-primary-color-rgb h-full w-full group-hover:flex transition justify-center items-center absolute hidden" id="featuredProductsborderhover_${item.id}">
                                                ${stock}
                                            </div>
                                        </div>`);
                        });
                        selectedProducts();
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error(xhr.responseText);
                    }
                });
            });
            $(document).on('click', '.product-select', function(e) {
                var id = $(this).attr('data-id');
                var stock = $(this).attr('data-stock');
                var qty = $('#productQty_' + id).text();
                if (stock > 0 && stock > qty) {
                    productSelect(id);
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: "{{ __('out_of_stock') }}"
                    })
                }
            });
            removeProductFromCart = (id) => {
                $(`#productSaleRow_${id}`).remove();
                const totalElement = document.getElementsByClassName('productSaleRow')
                if (totalElement.length == 0) {
                    $('#noProducts').show();
                }
                $('#featuredProductsborder_' + id).removeClass('primary-boder-color');
                $('#featuredProductsborderhover_' + id).addClass('hidden');
                $('#featuredProductsborderhover_' + id).removeClass('flex');
                $('#featuredProducts_' + id).text(0);
                countQty();
            }
            minusProduct = (id) => {
                if (Number($('#productQty_' + id).text()) > 1)
                    $('#productQty_' + id).text(Number($('#productQty_' + id).text()) - 1)

                $('#featuredProducts_' + id).text(Number($('#productQty_' + id).text()));
                countQty();
            }
            addProduct = (id, stock) => {
                if (document.getElementById(`productQty_${id}`)) {
                    if (Number($('#productQty_' + id).text()) < stock) {
                        $('#productQty_' + id).text(Number($('#productQty_' + id).text()) + 1);
                        countQty();
                    }
                    $('#featuredProductsborder_' + id).addClass('primary-boder-color');
                    $('#featuredProductsborderhover_' + id).removeClass('hidden');
                    $('#featuredProductsborderhover_' + id).addClass('flex');
                    $('#featuredProducts_' + id).text(Number($('#productQty_' + id).text()));
                } else {
                    productSelect(id);
                }
            }

            function productSelect(id) {
                $('#noProducts').hide();
                $.ajax({
                    url: '/product/details',
                    type: 'GET',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        var product = response.data.product;
                        if (product) {
                            var selectProduct = $(`#productSaleRow_${product.id}`);
                            if (selectProduct.length) {
                                var qty = Number($(`#productQty_${product.id}`).text());
                                $(`#productQty_${product.id}`).text(qty + 1)
                            } else {
                                var selectProducts = $('#selectProducts');
                                selectProducts.append(`<tr class="productSaleRow" id="productSaleRow_${product.id}" data-id="${product.id}">
                            <td class="p-2 h-12 text-cyan-900 text-base font-normal border-b primary-border-color">
                                <a href="javascript:void(0)" class="truncate w-44 clip text-ellipsis productPriceCustomizeModal" data-id="${product.id}">
                                    ${product.name}
                                </a>
                                <!-- Product price customization Modal Start -->
                                <div class="fixed z-10 inset-0 invisible overflow-y-auto" aria-labelledby="modal-title" role="dialog"
                                    aria-modal="true" id="productPriceCustomizationModal_${product.id}">
                                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                                            aria-hidden="true"></div>
                                        <span
                                            class="hidden sm:inline-block sm:align-middle sm:h-screen"
                                            aria-hidden="true">​</span>
                                        <div
                                            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                <div class="sm:flex sm:items-start">
                                                    <div class="mt-3 text-center sm:mt-0 sm:text-left">
                                                        <h3 class="text-lg leading-6 font-medium text-gray-900"
                                                            id="modal-title">
                                                            {{ __('product_price_customization') }}
                                                        </h3>
                                                        <div class="mt-2">
                                                            <div
                                                                class="grid gap-4 md:grid-cols-2 mt-2 w-full">
                                                                <div class="mt-3">
                                                                    <label class="text-slate-500"
                                                                        for="name">{{ __('product_name') }}
                                                                    </label>
                                                                    <input type="text"
                                                                        value="${product.name }"
                                                                        disabled
                                                                        id="product_name_${product.id }"
                                                                        placeholder="{{ __('enter_your_product_name') }}"
                                                                        class="border-slate-200 bg-slate-50 rounded-lg placeholder:text-slate-400 text-slate-400 focus:ring-slate-300 focus:border-transparent focus:ring-1 w-full mt-2" />
                                                                </div>
                                                                <div class="mt-3">
                                                                    <label class="text-slate-500"
                                                                        for="product_price">{{ __('product_price') }}
                                                                        <span
                                                                            class="text-red-500">*</span></label>
                                                                    <input type="text"
                                                                        value="${product.price }"
                                                                        id="product_price_${product.id }"
                                                                        data-tax-rate="${product.tax_rate }"
                                                                        name="price"
                                                                        class="border-slate-200 bg-slate-50 rounded-lg placeholder:text-slate-400 focus:ring-slate-300 focus:border-transparent focus:ring-1 w-full mt-2"
                                                                        placeholder="{{ __('enter_your_product_price') }}" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                <button type="button"
                                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm submitProductPriceCustomizationModal"
                                                    data-id="${product.id}">
                                                    {{ __('update_and_save') }}
                                                </button>
                                                <button type="button"
                                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm closeProductPriceCustomizationModal"
                                                    data-id="${product.id}">
                                                    {{ __('cancel') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product price customization Modal End -->
                            </td>
                            <td
                                class="p-2 h-12 text-center text-cyan-900 text-base font-normal border-b primary-border-color">
                                ${currencySymbol(product.discount)}
                            </td>
                            <td
                            <td class="p-2 h-12 text-center text-cyan-900 text-base font-normal border-b primary-border-color"
                                                id="productTax_${product.id}">
                                ${currencySymbol(product.tax)}
                            </td>
                            <td class="p-2 h-12 text-center text-cyan-900 text-base font-normal border-b primary-border-color productPrice"
                                                data-price="${product.price}"
                                                id="productPrice_${product.id}">
                                ${currencySymbol(product.price)}
                            </td>
                            <td
                                class="p-2 h-12 text-center text-cyan-900 text-base font-normal border-b primary-border-color">
                                <div class="flex justify-center items-center gap-2">
                                    <button
                                        class="w-4 h-4 primary-bg-color rounded-sm flex justify-center items-center" onclick="minusProduct(${product.id})">
                                        <img src="{{ asset('/icons/minus.svg') }}" class="w-4 h-4" />
                                    </button>
                                    <span class="text-cyan-900 text-base font-normal tracking-tight productQty" id="productQty_${product.id}">
                                        1
                                    </span>
                                    <button
                                        class="w-4 h-4 primary-bg-color rounded-sm flex justify-center items-center" onclick="addProduct(${product.id}, ${product.stock})">
                                        <img src="{{ asset('/icons/plus.svg') }}" class="w-4 h-4" />
                                    </button>
                                </div>
                            </td>
                            <td
                                class="p-2 h-12 w-24 text-right text-cyan-900 text-base font-normal border-b primary-border-color productSubtotal" id="productSubtotal_${product.id}" data-subtotal="${product.subtotal}">
                                ${currencySymbol(product.subtotal)}
                            </td>
                            <td class="w-12 h-12 border-b primary-border-color text-center">
                                <div class="p-0 m-auto flex w-5 h-5 bg-red-400 rounded-full justify-center items-center cursor-pointer" onclick="removeProductFromCart(${product.id})">
                                    <img src="{{ asset('/icons/remove.svg') }}" class="w-2 h-2" />
                                </div>
                            </td>
                        </tr>`);
                            }
                            $('#featuredProductsborder_' + id).addClass('primary-boder-color');
                            $('#featuredProductsborderhover_' + id).removeClass('hidden');
                            $('#featuredProductsborderhover_' + id).addClass('flex');
                            $('#featuredProducts_' + id).text(Number($('#productQty_' + id).text()));
                        }

                        countQty();
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error(xhr.responseText);
                    }
                });
            }
            countQty = function() {
                let totalElement = document.getElementsByClassName('productSaleRow')
                var totalQty = 0;
                var grandSubtotal = 0;
                for (var i = 0; i < totalElement.length; i++) {
                    var productQty = totalElement[i].getElementsByClassName('productQty')[0].innerHTML;
                    var productSubtotal = totalElement[i].getElementsByClassName('productSubtotal')[0]
                        .getAttribute('data-subtotal');
                    var subTotal = Number(productQty) * Number(productSubtotal);
                    var grandSubtotal = Number(grandSubtotal) + Number(totalElement[i].getElementsByClassName(
                        'productSubtotal')[0].innerText = subTotal.toFixed(2));
                    totalElement[i].getElementsByClassName('productSubtotal')[0].innerText = currencySymbol(
                        subTotal);
                    var totalQty = (Number(totalQty) + Number(totalElement[i].getElementsByClassName(
                        'productQty')[0].innerHTML));
                }
                $('#totalDiscount').html('$ 0.00');
                $('.discount').html('$ 0.00');
                $('#totalProduct').html(totalElement.length);
                $('#totalItem').html(totalQty);
                $('#totalAmount').html(currencySymbol(grandSubtotal));
                $('#totalGrand').html(currencySymbol(grandSubtotal)).attr('data-grand-price', grandSubtotal);
            }
            $(document).on('click', '#addCouponBtn', function(e) {
                $('#couponCodeInput').show();
                $('#removeCouponBtn').show();
                $('#addCouponBtn').hide();
            });
            $(document).on('click', '#removeCouponBtn', function(e) {
                $('#couponCodeInput').hide();
                $('#removeCouponBtn').hide();
                $('#addCouponBtn').show();
            });
            $(document).on('keyup', '#couponCodeInput', function(e) {
                var value = $(this).val();
                if (value == '') {
                    $('#applyCouponBtn').hide();
                    $('#removeCouponBtn').show();
                } else {
                    $('#applyCouponBtn').show();
                    $('#removeCouponBtn').hide();
                }
            });
            $(document).on('click', '#applyCouponBtn', function(e) {
                var value = $('#couponCodeInput').val();
                var price = $('#totalGrand').attr('data-grand-price');
                if (price == 0) {
                    Toast.fire({
                        icon: 'error',
                        title: "{{ __('no_product_selected') }}"
                    })
                }
                if (value && price > 0) {
                    $.ajax({
                        url: '/coupon/apply',
                        type: 'GET',
                        data: {
                            code: value,
                            price: price
                        },
                        success: function(response) {
                            $('#couponCodeInput').hide();
                            $('#removeCouponBtn').hide();
                            $('#applyCouponBtn').hide();
                            $('#addCouponBtn').show();

                            $('#totalDiscount').html(currencySymbol(response.data.discount));
                            $('.discount').html(currencySymbol(response.data.discount)).attr(
                                'data-coupon-id',
                                response.data.id);
                            const grandTotal = $('#totalGrand').attr('data-grand-price');
                            const newGrandTotal = Number(grandTotal) - Number(response.data
                                .discount);
                            $('#totalGrand').html(currencySymbol(newGrandTotal)).attr(
                                'data-grand-price',
                                newGrandTotal);
                            Toast.fire({
                                icon: 'success',
                                title: response.message
                            });
                        },
                        error: function(xhr, status, error) {
                            var response = JSON.parse(xhr.responseText);
                            Toast.fire({
                                icon: 'error',
                                title: response.message
                            })
                        }
                    });
                }
            });
            $('#addCustomerBtn').on('click', function(e) {
                $('#customerAddModal').removeClass('invisible');
            });
            $('#closeModalCustomer').on('click', function(e) {
                $('#customerAddModal').addClass('invisible');
            });
            $(document).on('click', '#submitCustomer', function(e) {
                var customerGroup = $('#customer_group_id').find(":selected").val();
                var name = $('#name').val();
                var phone_number = $('#phone_number').val();
                var email = $('#email').val();
                var password = $('#password').val();
                var tax_number = $('#tax_number').val();
                var address = $('#address').val();
                var country = $('#country').val();
                var city = $('#city').val();
                var state = $('#state').val();
                var post_code = $('#post_code').val();
                $.ajax({
                    url: '/customer/add',
                    type: 'GET',
                    data: {
                        customerGroup: customerGroup,
                        name: name,
                        phone_number: phone_number,
                        email: email,
                        password: password,
                        tax_number: tax_number,
                        address: address,
                        country: country,
                        city: city,
                        state: state,
                        post_code: post_code
                    },
                    success: function(response) {
                        $('#customer_group_id, #name, #phone_number, #email, #password, #tax_number, #address, #country, #city, #state, #post_code')
                            .val('');

                        $('#customerAddModal').addClass('invisible');
                        Toast.fire({
                            icon: 'success',
                            title: response.message
                        });
                    },
                    error: function(xhr, status, error) {
                        var response = JSON.parse(xhr.responseText);
                        Toast.fire({
                            icon: 'error',
                            title: response.message
                        })
                    }
                })
            });
            $(document).on('click', '.customer-select', function(e) {
                var name = $(this).attr('data-name');
                var id = $(this).attr('data-id');
                $('#searchCustomerInput').val(name).attr('data-id', id);
            });
            complate = (type) => {
                const totalGrand = $('#totalGrand').attr('data-grand-price');
                const customer_id = $('#searchCustomerInput').attr('data-id');
                const coupon_id = $('.discount').attr('data-coupon-id');
                const payment_method = $('input[name="payment"]:checked').val();

                let totalElement = document.getElementsByClassName('productSaleRow');
                let qtyArray = [];
                let ProductIdArray = [];
                let ProductPriceArray = [];

                for (var i = 0; i < totalElement.length; i++) {
                    var productQty = totalElement[i].getElementsByClassName('productQty')[0].innerHTML;
                    var productPrice = totalElement[i].getElementsByClassName('productPrice')[0].getAttribute(
                        'data-price');
                    var productId = totalElement[i].getAttribute('data-id');
                    qtyArray.push(Number(productQty));
                    ProductIdArray.push(Number(productId));
                    ProductPriceArray.push(Number(productPrice));

                    $('#featuredProductsborder_' + productId).removeClass('primary-boder-color');
                    $('#featuredProductsborderhover_' + productId).addClass('hidden');
                    $('#featuredProductsborderhover_' + productId).removeClass('flex');
                    $('#featuredProducts_' + productId).text(0);

                }
                console.log(ProductPriceArray);
                if (totalElement.length == 0) {
                    Toast.fire({
                        icon: 'error',
                        title: "{{ __('no_product_selected') }}"
                    })
                } else {
                    $.ajax({
                        url: '/sale/pos',
                        type: 'GET',
                        data: {
                            type: type,
                            paid_amount: totalGrand,
                            qty: qtyArray,
                            price: ProductPriceArray,
                            product_ids: ProductIdArray,
                            customer_id: customer_id,
                            coupon_id: coupon_id,
                            payment_method: payment_method,
                        },
                        success: function(response) {
                            Toast.fire({
                                icon: 'success',
                                title: response.message
                            });
                            cancelSale();
                            if (type == 'Sales') {
                                window.location = 'sales/invoice/' + response.data.sale.id;
                            }
                        },
                        error: function(xhr, status, error) {
                            var response = JSON.parse(xhr.responseText);
                            Toast.fire({
                                icon: 'error',
                                title: response.message
                            })
                        }
                    });
                }

            }
            cancelSale = () => {
                let totalElement = document.getElementsByClassName('productSaleRow');
                for (var i = 0; i < totalElement.length; i++) {
                    var productId = totalElement[i].getAttribute('data-id');
                    $('#featuredProductsborder_' + productId).removeClass('primary-boder-color');
                    $('#featuredProductsborderhover_' + productId).addClass('hidden');
                    $('#featuredProductsborderhover_' + productId).removeClass('flex');
                    $('#featuredProducts_' + productId).text(0);
                }
                $('.productSaleRow').remove();
                $('#noProducts').show();
                countQty();
            }
            selectedProducts = () => {
                let totalElement = document.getElementsByClassName('productSaleRow');
                for (var i = 0; i < totalElement.length; i++) {
                    var id = totalElement[i].getAttribute('data-id');
                    $('#featuredProductsborder_' + id).addClass('primary-boder-color');
                    $('#featuredProductsborderhover_' + id).removeClass('hidden');
                    $('#featuredProductsborderhover_' + id).addClass('flex');
                    $('#featuredProducts_' + id).text(Number($('#productQty_' + id).text()));

                }
            }
            $(document).on('click', '.productPriceCustomizeModal', function(e) {
                let id = $(this).attr('data-id');
                $('#productPriceCustomizationModal_' + id).removeClass('invisible');
            });
            $(document).on('click', '.closeProductPriceCustomizationModal', function(e) {
                let id = $(this).attr('data-id');
                $('#productPriceCustomizationModal_' + id).addClass('invisible');
            });
            $(document).on('click', '.submitProductPriceCustomizationModal', function(e) {
                var id = $(this).attr('data-id');
                var price = $('#productPriceCustomizationModal_' + id + ' input[name="price"]').val();
                var taxRate = $('#productPriceCustomizationModal_' + id + ' input[name="price"]').attr(
                    'data-tax-rate');
                var tax = taxRate ?? 0;
                if (tax > 0) {
                    tax = Number(price) * Number(taxRate) / 100;
                }
                var subtotal = Number(price) + Number(tax);
                var qty = $('#productQty_' + id).text();
                $('#productTax_' + id).text(currencySymbol(Number(tax)));
                $('#productPrice_' + id).text(currencySymbol(Number(price))).attr('data-price', Number(
                    price));
                $('#productSubtotal_' + id).text(currencySymbol(Number(subtotal) * Number(qty))).attr(
                    'data-subtotal', subtotal);
                $('#productPriceCustomizationModal_' + id).addClass('invisible');
                countQty();
            });

        });
    </script>
</body>

</html>
