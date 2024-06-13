@extends('layout.app')
@section('title', __('new_shop'))
@section('content')
    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between card-header-color">
                            <span class="list-title text-white">{{ __('new_shop') }}</span>
                            <a href="{{ route('shop.index') }}" class="btn common-btn"><i class="fa fa-chevron-left "></i>
                                {{ __('back') }}</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('shop.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-2">{{ __('business_owner_name') }} <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="name" class="form-control"
                                                placeholder="{{ __('enter_your_shop_owner_name') }}">
                                            @error('name')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-2">{{ __('password') }} <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group mb-3">
                                                <input type="text" id="getPass" class="form-control"
                                                    placeholder="{{ __('enter_your_shop_owner_password') }}"
                                                    name="password">
                                            </div>
                                            @error('password')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-2">{{ __('email_address') }}<span
                                                    class="text-danger">*</span></label>
                                            <input type="email" name="email"
                                                placeholder="{{ __('enter_your_shop_owner_email_address') }}"
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
                                            <label class="mb-2">{{ __('shop_name') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="shop_name" class="form-control"
                                                placeholder="{{ __('enter_your_shop_name') }}">
                                            @error('shop_name')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="mb-2">{{ __('shop_category') }} <span
                                                    class="text-danger">*</span></label>
                                            <select name="shop_category_id" class="form-control">
                                                <option selected disabled>{{ __('select_a_option') }}
                                                </option>
                                                @foreach ($shopCategories as $shopCategory)
                                                    <option value="{{ $shopCategory->id }}">{{ $shopCategory->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('shop_category_id')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="mb-2">{{ __('shop_logo') }}</label>
                                            <input type="file" name="shop_logo" class="form-control">
                                            @error('shop_logo')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="mb-2">{{ __('shop_favicon') }}</label>
                                            <input type="file" name="shop_favicon" class="form-control">
                                            @error('shop_favicon')
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
