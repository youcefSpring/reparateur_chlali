@extends('layout.app')
@section('title', __('payrolls'))
@section('content')
    <section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span class="list-title">{{ __('payrolls') }}</span>
                    <button class="btn common-btn" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus"></i>
                        {{ __('add_payroll') }}</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table dataTable table-hover" style="width: 100%">
                            <thead class="table-bg-color">
                                <tr>
                                    <th class="not-exported">{{ __('sl') }}</th>
                                    <th>{{ __('created_by') }}</th>
                                    <th>{{ __('employee') }}</th>
                                    <th>{{ __('account') }}</th>
                                    <th>{{ __('amount') }}</th>
                                    <th>{{ __('date') }}</th>
                                    <th>{{ __('note') }}</th>
                                    <th class="not-exported">{{ __('action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payrolls as $payroll)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $payroll->user->name }}</td>
                                        <td>{{ $payroll->employee->user->name }}</td>
                                        <td>{{ $payroll->account->name }}</td>
                                        <td>{{ numberFormat($payroll->amount) }}</td>
                                        <td>{{ $payroll->date }}</td>
                                        <td>{{ $payroll->note ?? 'N/A' }}</td>
                                        <td>
                                            <a data-toggle="modal" data-target="#editeModal_{{ $payroll->id }}"
                                                href="#" class="btn btn-sm common-btn"><i class="fa fa-edit"></i></a>

                                            <a id="delete" href="{{ route('payroll.delete', $payroll->id) }}"
                                                class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <div id="editeModal_{{ $payroll->id }}" tabindex="-1" role="dialog"
                                        data-backdrop="static" aria-labelledby="editModalLabel" aria-hidden="true"
                                        class="modal fade text-left">
                                        <div role="document" class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form action="{{ route('payroll.update', $payroll->id) }}" method="POST">
                                                    @method('put')
                                                    @csrf
                                                    <div class="modal-header card-header-color">
                                                        <span id="editModalLabel" class="modal-title list-title text-white">
                                                            {{ __('edit_payroll') }}
                                                        </span>
                                                        <button type="button" data-dismiss="modal" aria-label="Close"
                                                            class="close"><span aria-hidden="true"><i
                                                                    class="fa fa-times text-white"></i></span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row mb-3">
                                                            <div class="col-md-12 form-group mt-2">
                                                                <label class="mb-2">{{ __('account') }} <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="account_id">
                                                                    <option disabled selected>
                                                                        {{ __('select_a_option') }}
                                                                    </option>
                                                                    @foreach ($accounts as $account)
                                                                        <option {{ $account->id == $payroll->account_id ? 'selected' : ''}} value="{{ $account->id }}">
                                                                            {{ $account->name }}
                                                                            ({{ $account->account_no }})
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('account_id')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-12 form-group mt-2">
                                                                <label class="mb-2">{{ __('employee') }} <span class="text-danger">*</span></label>
                                                                <select class="form-control" name="employee_id">
                                                                    <option disabled selected>
                                                                        {{ __('select_a_option') }}
                                                                    </option>
                                                                    @foreach ($employees as $employee)
                                                                        <option {{ $employee->id == $payroll->employee_id ? 'selected' : ''}} value="{{ $employee->id }}">
                                                                            {{ $employee->user->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('employee_id')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-12 mt-2">
                                                                <div class="form-group">
                                                                    <label class="mb-2">{{ __('amount') }} <span class="text-danger">*</span></label>
                                                                    <input type="text" name="amount" class="form-control mb-2" value="{{ $payroll->amount }}"
                                                                        placeholder="{{ __('enter_your_salary_amount') }}">
                                                                    @error('amount')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="mb-2">{{ __('date') }} <span class="text-danger">*</span></label>
                                                                    <input type="date" name="date" class="form-control mb-2" value="{{ $payroll->date }}"
                                                                        placeholder="{{ __('Enter_your_salary_date') }}">
                                                                    @error('date')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="mb-2">{{ __('note') }}</label>
                                                                    <textarea name="note" class="form-control" placeholder="{{ __('enter_your_salary_note') }}">{{ $payroll->note }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ __('close') }}</button>
                                                        <button type="submit"
                                                            class="btn common-btn">{{ __('update_and_save') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="createModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
        aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('payroll.store') }}" method="POST">
                    @csrf
                    <div class="modal-header card-header-color">
                        <span id="createModalLabel"
                            class="modal-title list-title text-white">{{ __('new_payroll') }}</span>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                                aria-hidden="true"><i class="fa fa-times text-white"></i></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-12 form-group mt-2">
                                <label class="mb-2">{{ __('account') }} <span class="text-danger">*</span></label>
                                <select class="form-control" name="account_id">
                                    <option disabled selected>
                                        {{ __('select_a_option') }}
                                    </option>
                                    @foreach ($accounts as $account)
                                        <option value="{{ $account->id }}">
                                            {{ $account->name }}
                                            ({{ $account->account_no }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('account_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group mt-2">
                                <label class="mb-2">{{ __('employee') }} <span class="text-danger">*</span></label>
                                <select class="form-control" name="employee_id">
                                    <option disabled selected>
                                        {{ __('select_a_option') }}
                                    </option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">
                                            {{ $employee->user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('employee_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="form-group">
                                    <label class="mb-2">{{ __('amount') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="amount" class="form-control mb-2"
                                        placeholder="{{ __('enter_your_salary_amount') }}">
                                    @error('amount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-2">{{ __('date') }} <span class="text-danger">*</span></label>
                                    <input type="date" name="date" class="form-control mb-2"
                                        placeholder="{{ __('Enter_your_salary_date') }}">
                                    @error('date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-2">{{ __('note') }}</label>
                                    <textarea name="note" class="form-control" placeholder="{{ __('enter_your_salary_note') }}"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('close') }}</button>
                        <button type="submit" class="btn common-btn">{{ __('submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
