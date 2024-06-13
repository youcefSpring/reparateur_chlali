@extends('layout.app')
@section('title', __('general_settings'))
@section('content')
    <section class="forms">
        <div class="container-fluid">
            <div class="row justify-content-center mt-5">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header custom-card-header d-flex align-items-center card-header-color">
                            <span class="list-title text-white">{{ __('general_settings') }}</span>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('settings.general.store', $generalSettings?->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('system_title') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="site_title" class="form-control"
                                                placeholder="{{ __('enter_your_site_title') }}"
                                                value="{{ $generalSettings->site_title ?? '' }}" />
                                            @error('site_title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('system_logo') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" name="site_logo" class="form-control" value="" />
                                        </div>
                                        @error('site_logo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('small_logo') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" name="small_logo" class="form-control" value="" />
                                        </div>
                                        @error('small_logo')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('favicon') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="file" name="favicon" class="form-control" value="" />
                                        </div>
                                        @error('favicon')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('currency') }} <span
                                                    class="text-danger">*</span></label>
                                            <select name="currency_id" class="form-control" required>
                                                @if ($currencies->isNotEmpty())
                                                    <option disabled selected{{ __('select_a_option') }}>
                                                    </option>
                                                    @foreach ($currencies as $currency)
                                                        <option
                                                            {{ isset($generalSettings->currency_id) && $generalSettings->currency_id == $currency->id ? 'selected' : '' }}
                                                            value="{{ $currency->id }}">{{ $currency->name }}</option>
                                                    @endforeach
                                                @else
                                                    <option disabled selected>
                                                        {{ __('no_option_available') }}</option>
                                                @endif

                                            </select>
                                            @error('currency_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-6 mt-2">
                                                <div class="form-group">
                                                    <label class="mb-2">{{ __('currency_position') }} <span
                                                            class="text-danger">*</span></label><br>
                                                    <label class="radio-inline" style="margin-right: 50px">
                                                        <input type="radio"
                                                            {{ isset($generalSettings->currency_position->value) && $generalSettings->currency_position->value == 'Prefix' ? 'checked' : '' }}
                                                            name="currency_position" value="Prefix">
                                                        {{ __('prefix') }}
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio"
                                                            {{ isset($generalSettings->currency_position->value) && $generalSettings->currency_position->value == 'Suffix' ? 'checked' : '' }}
                                                            name="currency_position" value="Suffix">
                                                        {{ __('suffix') }}
                                                    </label>
                                                </div>
                                                @error('currency_position')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <div class="form-group">
                                                    <label class="mb-2">{{ __('direction') }} <span
                                                            class="text-danger">*</span></label><br>
                                                    <label class="radio-inline" style="margin-right: 20px">
                                                        <input type="radio"
                                                            {{ isset($generalSettings->direction) && $generalSettings->direction == 'ltr' ? 'checked' : '' }}
                                                            name="direction" value="ltr">
                                                        {{ __('ltr') }}
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio"
                                                            {{ isset($generalSettings->direction) && $generalSettings->direction == 'rtl' ? 'checked' : '' }}
                                                            name="direction" value="rtl">
                                                        {{ __('rtl') }}
                                                    </label>
                                                </div>
                                                @error('direction')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-2">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('date_with_time') }} <span
                                                    class="text-danger">*</span></label><br>
                                            <label class="radio-inline" style="margin-right: 50px">
                                                <input type="radio"
                                                    {{ isset($generalSettings->date_with_time) && $generalSettings->date_with_time->value == 'Enable' ? 'checked' : '' }}
                                                    name="date_with_time" value="Enable">
                                                {{ __('enable') }}
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio"
                                                    {{ isset($generalSettings->date_with_time) && $generalSettings->date_with_time->value == 'Disable' ? 'checked' : '' }}
                                                    name="date_with_time" value="Disable">
                                                {{ __('disable') }}
                                            </label>
                                        </div>
                                        @error('date_with_time')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 mt-2">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('barcode_digits') }}
                                                <span class="text-danger">*</span></label>
                                            <input type="text" name="barcode_digits" class="form-control"
                                                placeholder="{{ __('enter_your_barcode_digits') }}"
                                                value="{{ $generalSettings->barcode_digits ?? '' }}" />
                                            @error('barcode_digits')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="@role('super admin') col-md-4 mt-2 @else col-md-2 mt-2 @endrole">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('date_format') }} <span
                                                    class="text-danger">*</span></label>
                                            <select name="date_format" class="form-control">
                                                <option disabled selected>{{ __('select_a_option') }}
                                                </option>
                                                @foreach ($dateFormats as $dateFormat)
                                                    <option
                                                        {{ isset($generalSettings->date_format->value) && $generalSettings->date_format->value == $dateFormat->value ? 'selected' : '' }}
                                                        value="{{ $dateFormat }}">{{ $dateFormat }}</option>
                                                @endforeach
                                            </select>
                                            @error('date_format')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="@role('super admin') col-md-4 mt-2 @else col-md-2 mt-2 @endrole">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('developed_by') }}</label>
                                            <input type="text" name="developed_by" class="form-control"
                                                placeholder="{{ __('developed_by_description') }}"
                                                value="{{ $generalSettings->developed_by ?? '' }}">
                                        </div>
                                    </div>
                                    @role('super admin')
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label class="mb-2">{{ __('copyright_text') }}</label>
                                                <input type="text" name="copyright_text" class="form-control"
                                                    placeholder="{{ __('copyright_text') }}"
                                                    value="{{ $generalSettings->copyright_text ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2">
                                            <div class="form-group">
                                                <label class="mb-2">{{ __('copyright_url') }}</label>
                                                <input type="text" name="copyright_url" class="form-control"
                                                    placeholder="{{ __('copyright_url') }}"
                                                    value="{{ $generalSettings->copyright_url ?? '' }}">
                                            </div>
                                        </div>
                                    @endrole
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('time_zone') }} <span
                                                    class="text-danger">*</span></label>
                                            <select name="timezone" class="form-control">
                                                @foreach ($zones as $zone)
                                                    <option {{ $zone['zone'] == env('APP_TIMEZONE') ? 'selected' : '' }}
                                                        value="{{ $zone['zone'] }}">
                                                        {{ $zone['diff_from_GMT'] . ' - ' . $zone['zone'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('phone_number') }}</label>
                                            <input type="text" name="phone" class="form-control"
                                                placeholder="{{ __('enter_your_business_phone_number') }}"
                                                value="{{ $generalSettings->phone ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('email_address') }}</label>
                                            <input type="text" name="email" class="form-control"
                                                placeholder="{{ __('enter_your_business_email_address') }}"
                                                value="{{ $generalSettings->email ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-2">
                                        <div class="form-group">
                                            <label class="mb-2">{{ __('address') }}</label>
                                            <input type="text" name="address" class="form-control"
                                                placeholder="{{ __('enter_your_business_address') }}"
                                                value="{{ $generalSettings->address ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group my-3">
                                    <button type="submit" class="btn common-btn ml-2"
                                        style="margin-left: 12px">{{ __('update_and_save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
