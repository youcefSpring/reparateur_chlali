@extends('layout.app')
@section('title', __('new_customer'))
@section('content')
    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between card-header-color">
                            <span class="list-title text-white">{{ __('new_customer') }}</span>
                            <a href="{{ route('customer.index') }}" class="btn common-btn2"><i class="fa fa-chevron-left "></i>
                                {{ __('back') }}</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('customer.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('group') }}</label>
                                            <select class="form-control" name="customer_group_id">
                                                <option selected disabled>{{ __('select_a_option') }}
                                                </option>
                                                @foreach ($customerGroups as $customerGroup)
                                                    <option value="{{ $customerGroup->id }}">{{ $customerGroup->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('customer_group_id')
                                                <span class="text-danger">{{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('name') }} <span
                                                    class="text-danger">*</span></strong> </label>
                                            <input type="text" id="name" name="name" class="form-control"
                                                placeholder="{{ __('enter_your_customer_name') }}">
                                            @error('name')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('company_name') }}</label>
                                            <input type="text" name="company_name" class="form-control"
                                                placeholder="{{ __('enter_your_customer_company_name') }}">
                                            @if ($errors->has('company_name'))
                                                <span class="text-danger">{{ $message }}
                                                </span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="mb-2">{{ __('email_address') }}</label>
                                        <input type="email" name="email"
                                            placeholder="{{ __('enter_your_customer_email_address') }}"
                                            class="form-control">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="mb-2">{{ __('phone_number') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="number" name="phone_number" class="form-control"
                                            placeholder="{{ __('enter_your_customer_phone_number') }}">
                                        @error('phone_number')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label class="mb-2">{{ __('tax_number') }}</label>
                                        <input type="number" name="tax_no" class="form-control"
                                            placeholder="{{ __('enter_your_customer_tax_number') }}">
                                        @if ($errors->has('tax_no'))
                                            <span class="text-danger">{{ $message }}
                                            </span>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="mb-2">{{ __('address') }}</label>
                                    <input type="text" name="address" class="form-control"
                                        placeholder="{{ __('enter_your_customer_address') }}">
                                    @error('address')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label class="mb-2">{{ __('password') }}</label>
                                    <input type="password" name="password" class="form-control"
                                        placeholder="{{ __('enter_your_customer_password') }}">
                                    @if ($errors->has('address'))
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="mb-2">{{ __('city') }}</label>
                                <input type="text" name="city" class="form-control"
                                    placeholder="{{ __('enter_your_customer_city') }}">
                                @error('city')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="mb-2">{{ __('state') }}</label>
                                <input type="text" name="state" class="form-control"
                                    placeholder="{{ __('enter_your_customer_state') }}">
                                @error('state')
                                    <span class="text-danger">{{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="mb-2">{{ __('post_code') }}</label>
                                <input type="text" name="post_code" class="form-control"
                                    placeholder="{{ __('enter_your_customer_post_code') }}">
                                @error('postal_code')
                                    <span class="text-danger">{{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="mb-2">{{ __('country') }}</label>
                                <input type="text" name="country" class="form-control"
                                    placeholder="{{ __('enter_your_customer_country') }}">
                                @error('country')
                                    <span class="text-danger">{{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn common-btn">{{ __('submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</section>
@endsection
