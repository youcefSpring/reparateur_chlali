@extends('layout.app')
@section('title', __('subscriptions'))
@section('content')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #29aae1;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #29aae1;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
    <section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span class="list-title">{{ __('subscriptions') }}</span>
                    <button class="btn common-btn" data-toggle="modal" data-target="#createModal"><i
                            class="fa fa-plus"></i>&nbsp;&nbsp;
                        {{ __('add_subscription') }}</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table dataTable table-hover">
                            <thead class="table-bg-color">
                                <tr>
                                    <th class="not-exported">{{ __('sl') }}</th>
                                    <th>{{ __('title') }}</th>
                                    <th>{{ __('price') }}</th>
                                    <th>{{ __('shop_limit') }}</th>
                                    <th>{{ __('product_limit') }}</th>
                                    <th>{{ __('recurring_type') }}</th>
                                    <th>{{ __('status') }}</th>
                                    <th width="500px">{{ __('description') }}</th>
                                    <th>{{ __('action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subscriptions as $subscription)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $subscription->title }}</td>
                                        <td>{{ numberFormat($subscription->price) }}</td>
                                        <td>{{ $subscription->shop_limit }}</td>
                                        <td>{{ $subscription->product_limit }}</td>
                                        <td>{{ $subscription->recurring_type }}</td>
                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" class="subscriptionStatus"
                                                    data-id="{{ $subscription->id }}"
                                                    {{ $subscription->status->value == 'Active' ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <div class="description-content">{{ $subscription->description }}</div>
                                            <button id="see-more">See More</button>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn common-btn py-0 px-1" href="#" role="button"
                                                    id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="fa fa-ellipsis-h"></i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="">
                                                    <a href="#" class="dropdown-item" data-toggle="modal"
                                                        data-target="#edit_subscription_{{ $subscription->id }}"><i
                                                            class="fa fa-edit text-info"></i>&nbsp;&nbsp;
                                                        {{ __('edit') }}</a>
                                                </div>
                                            </div>
                                            <div id="edit_subscription_{{ $subscription->id }}" tabindex="-1"
                                                data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true" class="modal fade text-left">
                                                <div role="document" class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <form
                                                            action="{{ route('subscription.update', $subscription->id) }}"
                                                            method="POST">
                                                            @method('put')
                                                            @csrf
                                                            <div class="modal-header card-header-color">
                                                                <span id="exampleModalLabel"
                                                                    class="list-title modal-title text-white">{{ __('edit_subscription') }}</span>
                                                                <button type="button" data-dismiss="modal"
                                                                    aria-label="Close" class="close"><span
                                                                        aria-hidden="true"><i
                                                                            class="fa fa-times text-white"></i></span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-12 mb-2">
                                                                        <x-input name="title" title="{{ __('title') }}"
                                                                            type="text" :required="true"
                                                                            value="{{ $subscription->title }}"
                                                                            placeholder="{{ __('enter_your_subscription_title') }}" />
                                                                    </div>
                                                                    <div class="col-md-12 mb-2">
                                                                        <x-input name="price" title="{{ __('price') }}"
                                                                            type="text" :required="true"
                                                                            value="{{ $subscription->price }}"
                                                                            placeholder="{{ __('enter_your_subscription_price') }}" />
                                                                    </div>
                                                                    <div class="col-md-12 mb-2">
                                                                        <x-input name="shop_limit"
                                                                            title="{{ __('shop_limit') }}" type="number"
                                                                            :required="true"
                                                                            value="{{ $subscription->shop_limit }}"
                                                                            placeholder="{{ __('enter_your_subscription_shop_limit') }}" />
                                                                    </div>
                                                                    <div class="col-md-12 mb-2">
                                                                        <x-input name="product_limit"
                                                                            title="{{ __('product_limit') }}"
                                                                            type="number" :required="true"
                                                                            value="{{ $subscription->product_limit }}"
                                                                            placeholder="{{ __('enter_your_subscription_product_limit') }}" />
                                                                    </div>
                                                                    <div class="col-md-12 mb-2">
                                                                        <x-select name="recurring_type"
                                                                            title="{{ __('recurring_type') }}"
                                                                            placeholder="{{ __('select_a_option') }}">
                                                                            @foreach ($recurringTypes as $recurringType)
                                                                                <option
                                                                                    {{ $subscription->recurring_type->value == $recurringType->value ? 'selected' : '' }}
                                                                                    value="{{ $recurringType->value }}">
                                                                                    {{ $recurringType->value }}
                                                                                </option>
                                                                            @endforeach
                                                                        </x-select>
                                                                    </div>
                                                                    <div class="col-md-12 mb-2">
                                                                        <x-select name="status"
                                                                            title="{{ __('status') }}"
                                                                            placeholder="{{ __('select_a_option') }}">
                                                                            @foreach ($statuses as $status)
                                                                                <option
                                                                                    {{ $subscription->status->value == $status->value ? 'selected' : '' }}
                                                                                    value="{{ $status->value }}">
                                                                                    {{ $status->value }}
                                                                                </option>
                                                                            @endforeach
                                                                        </x-select>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label
                                                                                class="mb-2">{{ __('description') }}</label>
                                                                            <textarea name="description" class="form-control" placeholder="{{ __('enter_your_subscription_description') }}">{{ $subscription->description }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">{{ __('close') }}</button>
                                                                <button type="submit"
                                                                    class="btn common-btn">{{ __('update_and_save') }}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="createModal" tabindex="-1" data-backdrop="static" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('subscription.store') }}" method="POST">
                    @csrf
                    <div class="modal-header card-header-color">
                        <span id="exampleModalLabel"
                            class="list-title modal-title text-white">{{ __('new_subscription') }}</span>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                                aria-hidden="true"><i class="fa fa-times text-white"></i></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <x-input name="title" title="{{ __('title') }}" type="text" :required="true"
                                    placeholder="{{ __('enter_your_subscription_title') }}" />
                            </div>
                            <div class="col-md-12 mb-2">
                                <x-input name="price" title="{{ __('price') }}" type="text" :required="true"
                                    placeholder="{{ __('enter_your_subscription_price') }}" />
                            </div>
                            <div class="col-md-12 mb-2">
                                <x-input name="shop_limit" title="{{ __('shop_limit') }}" type="text"
                                    :required="true" placeholder="{{ __('enter_your_subscription_shop_limit') }}" />
                            </div>
                            <div class="col-md-12 mb-2">
                                <x-input name="product_limit" title="{{ __('product_limit') }}" type="number"
                                    :required="true" placeholder="{{ __('enter_your_subscription_product_limit') }}" />
                            </div>
                            <div class="col-md-12 mb-2">
                                <x-select name="recurring_type" title="{{ __('recurring_type') }}"
                                    placeholder="{{ __('select_a_option') }}">
                                    @foreach ($recurringTypes as $recurringType)
                                        <option value="{{ $recurringType->value }}">
                                            {{ $recurringType->value }}
                                        </option>
                                    @endforeach
                                </x-select>
                            </div>
                            <div class="col-md-12 mb-2">
                                <x-select name="status" title="{{ __('status') }}"
                                    placeholder="{{ __('select_a_option') }}">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->value }}">
                                            {{ $status->value }}
                                        </option>
                                    @endforeach
                                </x-select>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-2">{{ __('description') }}</label>
                                    <textarea name="description" class="form-control" placeholder="{{ __('enter_your_subscription_description') }}"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('close') }}</button>
                        <button type="submit" class="btn common-btn">{{ __('submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const content = document.querySelector('.description-content');
            const seeMoreBtn = document.getElementById('see-more');

            seeMoreBtn.addEventListener('click', function() {
                if (content.style.maxHeight) {
                    content.style.maxHeight = null;
                    seeMoreBtn.textContent = 'See Less';
                } else {
                    content.style.maxHeight = content.scrollHeight + 'px';
                    seeMoreBtn.textContent = 'See More';
                }
            });
        });
        $('.subscriptionStatus').on("change", function() {
            const id = $(this).attr('data-id')
            console.log(id);
            const url = "{{ url('subscription/status-chanage/') }}";
            if ($(this).is(":checked")) {
                window.location.href = url + '/' + id + '/Active';
            } else {
                window.location.href = url + '/' + id + '/Inactive';
            }
        });
    </script>
@endpush
