@extends('layout.app')
@section('title', __('attendance'))
@section('content')
    <section>
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <span class="list-title">{{ __('attendance') }}</span>
                <div>
                    <button type="button" class="btn common-btn" data-toggle="modal" data-target="#createModal"><i
                            class="fa fa-plus"></i>&nbsp;&nbsp;{{ __('add_attendance') }}</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover dataTable" style="width: 100%">
                        <thead class="table-bg-color">
                            <tr>
                                <th>{{ __('sl') }}</th>
                                <th>{{ __('created_by') }}</th>
                                <th>{{ __('date') }}</th>
                                <th>{{ __('employee') }}</th>
                                <th>{{ __('checkin') }}</th>
                                <th>{{ __('checkout') }}</th>
                                <th class="not-exported">{{ __('action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $attendance)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $attendance->user->name }}</td>
                                    <td>{{ $attendance->employee->user->name }}</td>
                                    <td>{{ dateFormat($attendance->date) }}</td>
                                    <td>{{ Carbon\Carbon::parse($attendance->checkin)->format('h:i A') }}</td>
                                    <td>{{ Carbon\Carbon::parse($attendance->checkout)->format('h:i A') }}</td>
                                    <td>
                                        <a id="delete" href="{{ route('attendance.delete', $attendance->id) }}"
                                            class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- Create Modal -->
    <div id="createModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="attendanceCreateModal"
        aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('attendance.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header card-header-color">
                        <span id="attendanceCreateModal"
                            class="modal-title list-title text-white">{{ __('new_attendance') }}</span>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                                aria-hidden="true"><i class="fa fa-times text-white"></i></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col-md-6 mb-3">
                                <x-select name="employee_id" title="{{ __('employee') }}"
                                    placeholder="{{ __('select_a_option') }}">
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">
                                            {{ $employee->user?->name }}
                                        </option>
                                    @endforeach
                                </x-select>
                            </div>
                            <div class="col-md-6  mb-3">
                                <x-input name="date" title="{{ __('purchase_date') }}" type="date" :required="true"
                                    placeholder="" />
                            </div>
                            <div class="col-md-6  mb-3">
                                <x-input name="checkin" title="{{ __('checkin') }}" type="time" :required="true"
                                    placeholder="" />
                            </div>
                            <div class="col-md-6  mb-3">
                                <x-input name="checkout" title="{{ __('checkout') }}" type="time" :required="true"
                                    placeholder="" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('close') }}</button>
                        <button type="submit" class="btn common-btn">{{ __('submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
