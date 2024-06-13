@extends('layout.app')
@section('title', __('stripe_payment_gateway_configure'))
@section('content')
    <section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span class="list-title">{{ __('stripe_payment_gateway_configure') }}</span>
                </div>
                <form method="post" action="{{ route('payment-gateway.update') }}">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group mb-3">
                                <label class="mb-2">{{ __('public_key') }} <span class="text-danger">*</span></label>
                                <input type="text" name="public_key" class="form-control" value="{{ env('STRIPE_KEY') }}"
                                    placeholder="{{ __('enter_your_public_key') }}">
                                @error('public_key')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2">{{ __('secret_key') }} <span class="text-danger">*</span></label>
                                <input type="text" name="secret_key" class="form-control"  value="{{ env('STRIPE_SECRET') }}"
                                    placeholder="{{ __('enter_your_secret_key') }}">
                                @error('secret_key')
                                    <span class="text-danger">{{ $errors->first('secret_key') }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit"class="btn common-btn">{{ __('submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
