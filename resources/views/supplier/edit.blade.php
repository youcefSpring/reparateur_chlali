@extends('layout.app')
@section('title', __('supplier_edit'))
@section('content')
    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between card-header-color">
                            <span class="list-title text-white">{{ __(' Edit Supplier') }}</span>
                            <a href="{{ route('supplier.index') }}" class="btn common-btn"><i class="fa fa-chevron-left "></i>
                                {{ __('back') }}</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('supplier.update', $supplier->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('name') }} <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="name" value="{{ $supplier->name }}"
                                                placeholder="{{ __('enter_your_supplier_name') }}" class="form-control">
                                            @if ($errors->has('Name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="row">
                                            <div class="col-lg-11">
                                                <div class="form-group">
                                                    <label class="mb-2">{{ __('image') }}</label>
                                                    <input type="file" name="image" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-lg-1 mt-3">
                                                <img src="{{ $supplier->thumbnail->file ?? asset('defualt/defualt.jpg') }}"
                                                    height="50" width="50">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('company_name') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="company_name" value="{{ $supplier->company_name }}"
                                                required class="form-control"
                                                placeholder="{{ __('enter_your_supplier_company_name') }}">
                                            @if ($errors->has('company_name'))
                                                <span class="text-danger">{{ $errors->first('company_name') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('tax_number') }}</label>
                                            <input type="text" name="vat_number" value="{{ $supplier->vat_number }}"
                                                placeholder="{{ __('enter_your_supplier_tax_number') }}" class="form-control">
                                            @if ($errors->has('vat_number'))
                                                <span class="text-danger">{{ $errors->first('vat_number') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('email_address') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" name="email" value="{{ $supplier->email }}"
                                                placeholder="{{ __('enter_your_supplier_phone_number') }}" class="form-control">
                                            @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('phone_number') }}<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="phone_number" value="{{ $supplier->phone_number }}"
                                                placeholder="{{ __('enter_your_supplier_phone_number') }}" class="form-control">
                                            @if ($errors->has('phone_number'))
                                                <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('address') }}<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="address" value="{{ $supplier->address }}"
                                                placeholder="{{ __('enter_your_supplier_address') }}" class="form-control">
                                            @if ($errors->has('address'))
                                                <span class="text-danger">{{ $errors->first('address') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('city') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="city" value="{{ $supplier->city }}" required
                                                class="form-control" placeholder="{{ __('enter_your_supplier_city') }}">
                                            @if ($errors->has('city'))
                                                <span class="text-danger">{{ $errors->first('city') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('state') }}</label>
                                            <input type="text" name="state" value="{{ $supplier->state }}"
                                                placeholder="{{ __('enter_your_supplier_state') }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('post_code') }}</label>
                                            <input type="text" name="postal_code"
                                                value="{{ $supplier->postal_code }}"
                                                placeholder="{{ __('enter_your_supplier_post_code') }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('country') }}</label>
                                            <input type="text" name="country" value="{{ $supplier->country }}"
                                                placeholder="{{ __('enter_your_supplier_country') }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mt-3">
                                            <button type="submit" class="btn common-btn">{{ __('update_and_save') }}</button>
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
