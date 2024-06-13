@extends('layout.app')
@section('title', __('new_product'))
@section('content')
    <style>
        .jpreview-image {
            width: 308px;
            height: 250px;
            margin: 10px;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;

        }
    </style>
    <section class="forms">
        <div class="container-fluid">
            <form id="product" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-7 col-md-12 mb-3">
                        <div class="card">
                            <div class="card-header d-flex align-items-center card-header-color">
                                <span class="list-title text-white">{{ __('new_product') }}</span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <x-input name="name" title="{{ __('name') }}"
                                            placeholder="{{ __('enter_your_product_name') }}" />
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <x-select name="type" title="{{ __('type') }}"
                                            placeholder="{{ __('select_a_option') }}">
                                            @foreach ($productTypes as $type)
                                                <option value="{{ $type->value }}">{{ $type->value }}</option>
                                            @endforeach
                                        </x-select>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <x-inputGroup type="text" value="" name="code" id="code"
                                            placeholder="{{ __('enter_your_code_or_generate') }}"
                                            title="{{ __('code') }}" :required="true"></x-inputGroup>
                                    </div>
                                    <div class="col-md-4">
                                        <x-select name="barcode_symbology" title="{{ __('barcode_symbology') }}"
                                            placeholder="{{ __('select_a_option') }}">
                                            @foreach ($barcodeSymbologyes as $barcodeSymbology)
                                                <option value="{{ $barcodeSymbology->value }}">
                                                    {{ $barcodeSymbology->value }}</option>
                                            @endforeach
                                        </x-select>
                                    </div>
                                    <div id="combo-section" class="col-12 mb-3">
                                        <div class="combo-filed">
                                            <div class="col-md-12">
                                                <label class="mb-2">{{ __('add_product') }}</label>
                                                <div class="search-box input-group mb-3">
                                                    <button class="btn common-btn"><i class="fa fa-barcode"></i></button>
                                                    <input type="text" name="product_code_name" id="searchProduct"
                                                        placeholder="{{ __('please_type_product_code_and_select') }}"
                                                        class="form-control" />
                                                    <div class="position-absolute w-100 products p-2 shadow"
                                                        id="productList"></div>
                                                </div>
                                                <div class="table-responsive">
                                                    <table id="myTable" class="table table-hover order-list">
                                                        <thead>
                                                            <tr>
                                                                <th>{{ __('product') }}</th>
                                                                <th>{{ __('code') }}</th>
                                                                <th>{{ __('quantity') }}</th>
                                                                <th>{{ __('purchase_cost') }}</th>
                                                                <th>{{ __('sub_total') }}</th>
                                                                <th>{{ __('action') }}</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="comboProduct"></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <x-select name="brand_id" title="{{ __('brand') }}"
                                            placeholder="{{ __('select_a_option') }}">
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                                            @endforeach
                                        </x-select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <x-select name="category_id" title="{{ __('category') }}"
                                            placeholder="{{ __('select_a_option') }}">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </x-select>
                                    </div>
                                </div>
                                <div id="unit-section">
                                    <div id="unit-filed">
                                        <div class="row">
                                            <div class="col-md-4  mb-3">
                                                <x-select name="unit_id" title="{{ __('product_unit') }}"
                                                    placeholder="{{ __('select_a_option') }}">
                                                    @foreach ($units as $unit)
                                                        <option value="{{ $unit->id }}">
                                                            {{ $unit->name }}
                                                        </option>
                                                    @endforeach
                                                </x-select>
                                            </div>
                                            <div class="col-md-4  mb-3">
                                                <x-select name="sale_unit_id" title="{{ __('sale_unit') }}"
                                                    placeholder="{{ __('select_a_sale_unit') }}"
                                                    :required="false"></x-select>
                                            </div>
                                            <div class="col-md-4  mb-3">
                                                <x-select name="purchase_unit_id" title="{{ __('purchase_unit') }}"
                                                    placeholder="{{ __('select_a_purchase_unit') }}"
                                                    :required="false"></x-select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4  mb-3">
                                                <x-input name="cost" title="{{ __('purchase_cost') }}" type="text"
                                                    placeholder="{{ __('enter_your_purchase_cost') }}" :required="false" />
                                            </div>
                                            <div class="col-md-4  mb-3">
                                                <x-input name="price" title="{{ __('selling_price') }}" type="text"
                                                    placeholder="{{ __('enter_your_selling_price') }}" />
                                            </div>
                                            <div class="col-md-4  mb-3">
                                                <x-input name="alert_quantity" title="{{ __('alert_quantity') }}"
                                                    type="number" placeholder="{{ __('enter_your_alert_quantity') }}"
                                                    :required="false" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <x-input name="image" title="{{ __('image') }}" type="file"
                                            placeholder="" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <x-select name="tax_id" title="{{ __('tax') }}" :required="false"
                                            placeholder="{{ __('select_a_option') }}">
                                            @foreach ($taxs as $tax)
                                                <option value="{{ $tax->id }}">{{ $tax->name }}</option>
                                            @endforeach
                                        </x-select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <x-select name="tax_method" title="{{ __('tax_method') }}"
                                            placeholder="{{ __('select_a_option') }}" :required="false">
                                            @foreach ($taxMethods as $taxMethod)
                                                <option value="{{ $taxMethod->value }}">{{ $taxMethod->value }}</option>
                                            @endforeach
                                        </x-select>
                                    </div>
                                    <div class="col-md-12  mb-2">
                                        <div class="form-check">
                                            <input name="featured" class="form-check-input" type="checkbox"
                                                id="isFeatured" value="1">
                                            <label class="form-check-label" for="isFeatured">
                                                {{ __('featured_product_will_be_displayed_in_pos') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2" id="batch-option">
                                        <div class="form-check">
                                            <input name="is_batch" type="checkbox" id="is-batch" value="1"
                                                class="form-check-input">
                                            <label class="form-check-label"
                                                for="is-batch">{{ __('this_product_has_batch_and_expired_date') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2" id="variant-option">
                                        <div class="form-check">
                                            <input name="is_variant" type="checkbox" id="is-variant" value="1"
                                                class="form-check-input">
                                            <label class="form-check-label"
                                                for="is-variant">{{ __('this_product_has_variant') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="variant-section">
                                        <div class="col-md-12 form-group mt-2">
                                            <input type="text" name="variant" class="form-control"
                                                placeholder="{{ __('enter_variant_seperated_by_comma') }}">
                                        </div>
                                        <div class="table-responsive ml-2">
                                            <table id="variant-table" class="table table-hover variant-list">
                                                <thead>
                                                    <tr>
                                                        <th><i class="fa fa-circle"></i></th>
                                                        <th>{{ __('name') }}</th>
                                                        <th>{{ __('code') }}</th>
                                                        <th>{{ __('additional_price') }}</th>
                                                        <th><i class="fa fa-trash"></i></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <div class="form-check">
                                            <input name="promotion" type="checkbox" id="promotion" value="1"
                                                class="form-check-input">
                                            <label class="form-check-label"
                                                for="promotion">{{ __('add_promotional_price') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div id="promotion_price">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <x-input name="promotion_price" title="{{ __('promotional_price') }}"
                                                        placeholder="{{ __('enter_your_promotion_price') }}"
                                                        type="number" :required="false"></x-input>
                                                </div>
                                                <div class="col-md-4" id="start_date">
                                                    <x-input name="starting_date" title="{{ __('start_date') }}"
                                                        type="date" placeholder="" :required="false"></x-input>
                                                </div>
                                                <div class="col-md-4 mb-3" id="last_date">
                                                    <x-input name="last_date" title="{{ __('end_date') }}"
                                                        type="date" placeholder="" :required="false"></x-input>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card my-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>{{ __('product_details') }}</label>
                                            <textarea name="product_details" id="summernote"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <div class="row  mt-3">
                                            <div class="col-12 col-md-6">
                                                <button type="reset"
                                                    class="btn mb-sm-2 reset-btn w-100">{{ __('reset') }}</button>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <button type="submit"
                                                    class="btn common-btn w-100">{{ __('submit') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <style>
        .product-item {
            background: #cccccc1c;
            border-radius: 8px;
            margin-bottom: 4px;
            cursor: pointer;
        }

        .products {
            background-color: #eef1f5 !important;
            max-height: 400px;
            z-index: 999;
            top: 40px;
            box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
            display: none;
            overflow-x: hidden;
            overflow-y: scroll;
        }
    </style>
@endsection
@push('scripts')
    <script>
        $("#digital").hide();
        $("#combo-section").hide();
        $("#variant-section").hide();
        $("#promotion_price").hide();

        $('select[name="type"]').on("change", function() {
            const value = $(this).val();
            if (value == 'Combo') {
                $("#combo-section").show();
                $("#batch-option").hide();
                $("#variant-option").hide();
            } else {
                $("#combo-section").hide();
                $("#batch-option").show();
                $("#variant-option").show();
            }
        });
    </script>
    <script>
        $('select[name="unit_id"]').on("change", function() {
            var unitID = $(this).val();
            if (unitID) {
                $.ajax({
                    url: "{{ route('product.sale.unit') }}",
                    type: "GET",
                    data: {
                        id: unitID,
                    },
                    dataType: "json",
                    success: function(res) {
                        $('select[name="sale_unit_id"]').empty();
                        $('select[name="purchase_unit_id"]').empty();
                        $.each(res.data.unit, function(key, value) {
                            $('select[name="sale_unit_id"]').append(
                                '<option value="' + key + '">' + value + "</option>"
                            );
                            $('select[name="purchase_unit_id"]').append(
                                '<option value="' + key + '">' + value + "</option>"
                            );
                        });
                    },
                });
            } else {
                $('select[name="sale_unit_id"]').empty();
                $('select[name="purchase_unit_id"]').empty();
            }
        });
    </script>
    <script src="{{ asset('assets/product/create.js') }}"></script>
@endpush
