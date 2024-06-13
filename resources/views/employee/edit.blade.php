@extends('layout.app')
@section('title', __('employee_edit'))
@section('content')
    <section class="forms">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between card-header-color">
                            <span class="list-title text-white">{{ __('employee_edit') }}</span>
                            <a href="{{ route('employee.index') }}" class="btn common-btn"><i class="fa fa-chevron-left "></i>
                                {{ __('back') }}</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('employee.update', $employee->id) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label class="mb-2">{{ __('name') }} <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="name" required class="form-control"
                                                placeholder="{{ __('enter_your_employee_name') }}"
                                                value="{{ $employee->user->name }}">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label class="mb-2">{{ __('password') }} <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <input type="text" class="form-control"
                                                    placeholder="{{ __('enter_your_employee_password') }}" name="password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label class="mb-2">{{ __('email_address') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" name="email"
                                                placeholder="{{ __('enter_your_employee_email_address') }}" required
                                                class="form-control" value="{{ $employee->user->email }}">
                                            @error('email')
                                                <span class="text-danger">
                                                    {{ $errors->first('email') }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label class="mb-2">{{ __('phone_number') }} <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="phone" required class="form-control"
                                                placeholder="{{ __('enter_your_employee_phone_number') }}"
                                                value="{{ $employee->user->phone }}">
                                            @error('phone')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label class="mb-2">{{ __('role') }}<span
                                                    class="text-danger">*</span></label>
                                            <select name="role_name" class="form-control">
                                                <option selected disabled>{{ __('select_a_option') }}
                                                </option>
                                                @foreach ($roles as $role)
                                                    <option
                                                        {{ isset($employee->user->roles[0]->name) && $employee->user->roles[0]->name == $role->name ? 'selected' : '' }}
                                                        value="{{ $role->name }}">{{ ucfirst($role->name) }}
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
                                                    <option
                                                        {{ isset($employee->department_id) && $employee->department_id == $department->id ? 'selected' : '' }}
                                                        value="{{ $department->id }}">{{ $department->name }}
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
                                                value="{{ $employee->country }}"
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
                                                value="{{ $employee->city }}"
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
                                                value="{{ $employee->address }}"
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
                                                value="{{ $employee->staff_id }}"
                                                placeholder="{{ __('enter_your_employee_staff_id') }}">
                                            @error('staff_id')
                                                <span class="text-danger">{{ $message }}</span>
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
