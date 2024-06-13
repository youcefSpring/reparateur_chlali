@extends('layout.app')
@section('title', __('profile'))
@section('content')
    <style>
        .card-body {
            margin-top: 0px;
        }
    </style>
    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header custom-card-header card-header-color">
                            <span class="list-title text-white">{{ __('update_profile') }}</span>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('profile.update', auth()->id()) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('full_name') }} <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="name" value="{{ $user->name }}"
                                                class="form-control"
                                                placeholder="{{ __('enter_your_full_name') }}" />
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mt-2">
                                            <label class="mb-2">{{ __('email_address') }}<span
                                                    class="text-danger">*</span></label>
                                            <input type="email" name="email" value="{{ $user->email }}"
                                                class="form-control"
                                                placeholder="{{ __('enter_your_email_address') }}" />
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mt-2">
                                            <label class="mb-2">{{ __('phone_number') }}<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="phone" value="{{ $user->phone }}"
                                                class="form-control"
                                                placeholder="{{ __('enter_your_phone_number') }}" />
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group mt-2">
                                            <label class="mb-2">{{ __('profile_image') }}</label>
                                            <input type="file" name="image" class="form-control" />
                                        </div>
                                        <div class="form-group my-3">
                                            <button type="submit"
                                                class="btn common-btn">{{ __('update_and_save') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header custom-card-header card-header-color">
                            <span class="list-title text-white">{{ __('change_password') }}</span>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.password', auth()->user()->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mt-2">
                                            <label class="mb-2">{{ __('current_password') }}<span
                                                    class="text-danger">*</span></label>
                                            <input type="password" name="current_password" class="form-control"
                                                placeholder="{{ __('enter_your_current_password') }}" />
                                            @if ($errors->has('current_password'))
                                                <span class="text-danger">{{ $errors->first('current_password') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group mt-2">
                                            <label class="mb-2">{{ __('new_password') }}<span
                                                    class="text-danger">*</span> </label>
                                            <input type="password" name="password" class="form-control"
                                                placeholder="{{ __('enter_your_new_password') }}" />
                                            @if ($errors->has('password'))
                                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group mt-2">
                                            <label class="mb-2">{{ __('confirm_password') }}<span
                                                    class="text-danger">*</span></label>
                                            <input type="password" name="password_confirmation" id="password_confirmation"
                                                class="form-control"
                                                placeholder="{{ __('enter_your_confirm_password') }}" />

                                            @if ($errors->has('password_confirmation'))
                                                <span
                                                    class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group my-3">
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
