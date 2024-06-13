@extends('layout.app')
@section('title', __('new_store'))
@section('content')
    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between card-header-color">
                            <span class="list-title text-white">{{ __('new_store') }}</span>
                            <a href="{{ route('store.index') }}" class="btn common-btn"><i class="fa fa-chevron-left "></i>
                                {{ __('back') }}</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-2">{{ __('store_name') }} <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="store_name" class="form-control"
                                                placeholder="{{ __('enter_your_store_name') }}">
                                            @error('name')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-2">{{ __('store_email_address') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" name="store_email"
                                                placeholder="{{ __('enter_your_store_email_address') }}"
                                                class="form-control">
                                            @error('store_email')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-2">{{ __('store_phone_number') }}</label>
                                            <input type="text" name="phone_number"
                                                placeholder="{{ __('enter_your_store_phone_number') }}"
                                                class="form-control">
                                            @error('phone_number')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-2">{{ __('store_address') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="address"
                                                placeholder="{{ __('enter_your_store_address') }}" class="form-control">
                                            @error('address')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-2">{{ __('store_postal_code') }}</label>
                                            <input type="text" name="postal_code"
                                                placeholder="{{ __('enter_your_store_postal_code') }}"
                                                class="form-control">
                                            @error('postal_code')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-2">{{ __('store_city') }}</label>
                                            <input type="text" name="city"
                                                placeholder="{{ __('enter_your_store_city') }}" class="form-control">
                                            @error('city')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-2">{{ __('store_state') }}</label>
                                            <input type="text" name="state"
                                                placeholder="{{ __('enter_your_store_state') }}" class="form-control">
                                            @error('state')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-2">{{ __('store_country') }}</label>
                                            <input type="text" name="country"
                                                placeholder="{{ __('enter_your_store_country') }}" class="form-control">
                                            @error('country')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-2">{{ __('store_manager_name') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="name"
                                                placeholder="{{ __('enter_your_store_manager_name') }}"
                                                class="form-control">
                                            @error('name')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-2">{{ __('store_manager_email') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" name="email"
                                                placeholder="{{ __('enter_your_store_manager_email') }}"
                                                class="form-control">
                                            @error('email')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-2">{{ __('store_manager_password') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="password"
                                                placeholder="{{ __('enter_your_store_manager_password') }}"
                                                class="form-control">
                                            @error('password')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
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
                                        <div class="form-group mb-3">
                                            <label class="mb-2">{{ __('store_description') }}</label>
                                            <textarea type="text" name="description" placeholder="{{ __('enter_your_store_description') }}"
                                                class="form-control" rows="3"></textarea>
                                            @error('description')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <button type="submit" class="btn common-btn">{{ __('submit') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
