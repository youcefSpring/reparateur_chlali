@extends('layout.app')
@section('title', __('new_employee'))
@section('content')
    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between card-header-color">
                            <span class="list-title text-white">{{ __('new_employee') }}</span>
                            <a href="{{ route('employee.index') }}" class="btn common-btn"><i class="fa fa-chevron-left "></i>
                                {{ __('back') }}</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('employee.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-2">{{ __('name') }} <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="name" class="form-control"
                                                placeholder="{{ __('enter_your_employee_name') }}">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-2">{{ __('password') }} <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group mb-3">
                                                <input type="text" id="getPass" class="form-control"
                                                    placeholder="{{ __('enter_your_employee_password') }}" name="password">
                                                @error('password')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                                <div class="input-group-append">
                                                    <button class="btn common-btn" type="button"
                                                        id="generatePass">{{ __('qenerate') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-2">{{ __('email_address') }}<span
                                                    class="text-danger">*</span></label>
                                            <input type="email" name="email"
                                                placeholder="{{ __('enter_your_employee_email_address') }}"
                                                class="form-control">
                                            @error('email')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-2">{{ __('phone_number') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="phone" class="form-control"
                                                placeholder="{{ __('enter_your_employee_phone_number') }}">
                                            @error('phone')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-2">{{ __('role') }} <span
                                                    class="text-danger">*</span></label>
                                            <select name="role_name" class="form-control">
                                                <option selected disabled>{{ __('select_a_option') }}
                                                </option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->name }}">{{ ucfirst($role->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('role_name')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-2">{{ __('department') }} <span
                                                    class="text-danger">*</span></label>
                                            <select name="department_id" class="form-control">
                                                <option selected disabled>{{ __('select_a_option') }}
                                                </option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}">{{ $department->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('department_id')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-2">{{ __('country') }}</label>
                                            <input type="text" name="country" class="form-control"
                                                placeholder="{{ __('enter_your_employee_country') }}">
                                            @error('country')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-2">{{ __('city') }}</label>
                                            <input type="text" name="city" class="form-control"
                                                placeholder="{{ __('enter_your_employee_city') }}">
                                            @error('city')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-2">{{ __('address') }}</label>
                                            <input type="text" name="address" class="form-control"
                                                placeholder="{{ __('enter_your_employee_address') }}">
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="mb-2">{{ __('staff_id') }}</label>
                                            <input type="text" name="staff_id" class="form-control"
                                                placeholder="{{ __('enter_your_employee_staff_id') }}">
                                            @error('staff_id')
                                                <span class="text-danger">{{ $message }}</span>
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
@push('scripts')
    <script>
        $(document).on("click", '#generatePass', function() {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{ route('generate.password') }}",
                success: function(res) {
                    if (res) {
                        $("#getPass").val(res);
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: "Something is wrong"
                        })
                    }

                }
            });
        });
    </script>
@endpush
