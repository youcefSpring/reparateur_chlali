@extends('layout.app')
@section('title', __('smtp_configure'))
@section('content')
    <style>
        .card-body {
            margin-top: 0px;
        }
    </style>
    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 m-auto">
                    <form action="{{ route('settings.mail.store') }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h4>{{ __('smtp_configure') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group mt-2 col-lg-6">
                                        <label class="mb-2">{{ __('mail_host') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="host" class="form-control"
                                            value="{{ env('MAIL_HOST') }}" placeholder="{{ __('mail_host') }}" />
                                        @if ($errors->has('host'))
                                            <span class="text-danger">{{ $errors->first('host') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mt-2 col-lg-6">
                                        <label class="mb-2">{{ __('mail_address') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="email_from" class="form-control"
                                            value="{{ env('MAIL_FROM_ADDRESS') }}"
                                            placeholder="{{ __('mail_address') }}" />
                                        @if ($errors->has('email_from'))
                                            <span class="text-danger">{{ $errors->first('email_from') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mt-2 col-lg-6">
                                        <label class="mb-2">{{ __('mail_username') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="username" class="form-control"
                                            value="{{ env('MAIL_USERNAME') }}"
                                            placeholder="{{ __('mail_username') }}" />
                                        @if ($errors->has('username'))
                                            <span class="text-danger">{{ $errors->first('username') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mt-2 col-lg-6">
                                        <label class="mb-2">{{ __('mail_from_name') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="from_name" class="form-control"
                                            placeholder="{{ __('mail_from_name') }}"
                                            value="{{ env('MAIL_FROM_NAME') }}" />
                                        @if ($errors->has('from_name'))
                                            <span class="text-danger">{{ $errors->first('from_name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mt-2 col-lg-6">
                                        <label class="mb-2">{{ __('mail_port') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="port" class="form-control"
                                            value="{{ env('MAIL_PORT') }}" placeholder="{{ __('mail_port') }}" />
                                        @if ($errors->has('port'))
                                            <span class="text-danger">{{ $errors->first('port') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mt-2 col-lg-6">
                                        <label class="mb-2">{{ __('password') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="{{ __('password') }}" value="{{ env('MAIL_PASSWORD') }}"
                                            autocomplete="off" />
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mt-2">
                                        <label class="mb-2">{{ __('encryption') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="encryption" class="form-control"
                                            placeholder="{{ __('encryption') }}"
                                            value="{{ env('MAIL_ENCRYPTION') }}" />
                                        @if ($errors->has('encryption'))
                                            <span class="text-danger">{{ $errors->first('encryption') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn common-btn ml-2">
                                    {{ __('update_and_save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
