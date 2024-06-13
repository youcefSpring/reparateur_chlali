@extends('layout.app')
@section('title', __('customer_edit'))
@section('content')
    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between card-header-color">
                            <span class="list-title text-white">{{ __('customer_edit') }}</span>
                            <a href="{{ route('customer.index') }}" class="btn common-btn"><i class="fa fa-chevron-left "></i>
                                {{ __('back') }}</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('customer.update', $customer->id) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('group') }}</label>
                                            <select required class="form-control" name="customer_group_id">
                                                <option selected disabled>{{ __('select_a_option') }}</option>
                                                @foreach ($customerGroups as $customerGroup)
                                                    <option
                                                        {{ isset($customer->customer_group_id) && $customer->customer_group_id == $customerGroup->id ? 'selected' : '' }}
                                                        value="{{ $customerGroup->id }}">{{ $customerGroup->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('customer_group_id')
                                                <span class="text-danger">{{ $errors->first('customer_group_id') }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('name') }} <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="name" value="{{ $customer->name }}"
                                                placeholder="{{ __('enter_your_customer_name') }}" class="form-control">
                                                @error('name')
                                                <span class="text-danger">{{ $errors->first('name') }}
                                                </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('company_name') }} </label>
                                            <input type="text" name="company_name" value="{{ $customer->company_name }}"
                                                placeholder="{{ __('enter_your_customer_company_name') }}" class="form-control">
                                                @error('company_name')
                                                <span class="text-danger">{{ $errors->first('company_name') }}
                                                </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('email_address') }}</label>
                                            <input type="email" name="email" value="{{ $customer->email }}"
                                                placeholder="{{ __('enter_your_customer_email_address') }}" class="form-control">
                                                @error('email')
                                                <span class="text-danger">{{ $errors->first('email') }}
                                                </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('phone_number') }} <span
                                                class="text-danger">*</span></label>
                                            <input type="text" name="phone_number"
                                                placeholder="{{ __('enter_your_customer_phone_number') }}"
                                                value="{{ $customer->phone_number }}" class="form-control">
                                                @error('phone_number')
                                                <span class="text-danger">{{ $errors->first('phone_number') }}
                                                </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('tax_number') }}</label>
                                            <input type="text" name="tax_no" class="form-control"
                                                placeholder="{{ __('enter_your_customer_tax_number') }}"
                                                value="{{ $customer->tax_no }}">
                                                @error('tax_no')
                                                <span class="text-danger">{{ $errors->first('tax_no') }}
                                                </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('address') }} </label>
                                            <input type="text" name="address" placeholder="{{ __('enter_your_customer_address') }}"
                                                value="{{ $customer->address }}" class="form-control">
                                                @error('address')
                                                <span class="text-danger">{{ $errors->first('address') }}
                                                </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('city') }}</label>
                                            <input type="text" name="city" placeholder="{{ __('enter_your_customer_city') }}"
                                                value="{{ $customer->city }}" class="form-control">
                                                @error('city')
                                                <span class="text-danger">{{ $errors->first('city') }}
                                                </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('state') }}</label>
                                            <input type="text" name="state" value="{{ $customer->state }}"
                                                placeholder="{{ __('enter_your_customer_state') }}" class="form-control">
                                                @error('state')
                                                <span class="text-danger">{{ $errors->first('state') }}
                                                </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('post_code') }}</label>
                                            <input type="text" name="postal_code"
                                                value="{{ $customer->postal_code }}"
                                                placeholder="{{ __('enter_your_customer_post_code') }}" class="form-control">
                                                @error('postal_code')
                                                <span class="text-danger">{{ $errors->first('postal_code') }}
                                                </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('country') }}</label>
                                            <input type="text" name="country" value="{{ $customer->country }}"
                                                placeholder="{{ __('enter_your_customer_country') }}" class="form-control">
                                                @error('country')
                                                <span class="text-danger">{{ $errors->first('country') }}
                                                </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mt-3">
                                            <button type="submit"
                                                class="btn common-btn">{{ __('update_and_save') }}</button>
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
