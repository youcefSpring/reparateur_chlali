@extends('layout.app')
@section('title', __('new_supplier'))
@section('content')
    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between card-header-color">
                            <span class="list-title text-white">{{ __('new_supplier') }}</span>
                            <a href="{{ route('supplier.index') }}" class="btn common-btn"><i class="fa fa-chevron-left "></i>
                                {{ __('back') }}</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('supplier.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('name') }} <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="name" class="form-control"
                                                placeholder="{{ __('enter_your_supplier_name') }}">
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('image') }}</label>
                                            <input type="file" name="image" class="form-control">

                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('company_name') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="company_name" class="form-control"
                                                placeholder="{{ __('enter_your_supplier_company_name') }}">
                                            @if ($errors->has('company_name'))
                                                <span class="text-danger">{{ $errors->first('company_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('tax_number') }}</label>
                                            <input type="text" name="vat_number" class="form-control"
                                                placeholder="{{ __('enter_your_supplier_tax_number') }}">
                                            @if ($errors->has('vat_number'))
                                                <span class="text-danger">{{ $errors->first('vat_number') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('email_address') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" name="email"
                                                placeholder="{{ __('enter_your_supplier_email_address') }}"
                                                class="form-control">
                                            @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('phone_number') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="phone_number" class="form-control"
                                                placeholder="{{ __('enter_your_supplier_phone_number') }}">
                                            @if ($errors->has('phone_number'))
                                                <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('address') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="address" class="form-control"
                                                placeholder="{{ __('enter_your_supplier_address') }}">
                                            @if ($errors->has('address'))
                                                <span class="text-danger">{{ $errors->first('address') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('city') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="city" class="form-control"
                                                placeholder="{{ __('enter_your_supplier_city') }}">
                                            @if ($errors->has('city'))
                                                <span class="text-danger">{{ $errors->first('city') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('state') }}</label>
                                            <input type="text" name="state" class="form-control"
                                                placeholder="{{ __('enter_your_supplier_state') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('post_code') }}</label>
                                            <input type="text" name="postal_code" class="form-control"
                                                placeholder="{{ __('enter_your_supplier_post_code') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('country') }}</label>
                                            <input type="text" name="country" class="form-control"
                                                placeholder="{{ __('enter_your_supplier_country') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mt-4">
                                            <button type="submit"
                                                class="btn common-btn">{{ __('submit') }}</button>
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
