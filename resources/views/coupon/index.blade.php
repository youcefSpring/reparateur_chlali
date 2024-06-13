@extends('layout.app')
@section('title', __('coupons'))
@section('content')
    <section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span class="list-title">{{ __('coupons') }}</span>
                    <button class="btn common-btn" data-toggle="modal" data-target="#create-modal"><i class="fa fa-plus"></i>
                        {{ __('add_coupon') }}</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table dataTable">
                            <thead class="table-bg-color">
                                <tr>
                                    <th class="not-exported"></th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('code') }}</th>
                                    <th>{{ __('type') }}</th>
                                    <th>{{ __('amount') }}</th>
                                    <th>{{ __('minimum_amount') }}</th>
                                    <th>{{ __('maximum_amount') }}</th>
                                    <th>{{ __('quantity') }}</th>
                                    <th>{{ __('available') }}</th>
                                    <th>{{ __('expired_at') }}</th>
                                    <th>{{ __('created_by') }}</th>
                                    <th class="not-exported">{{ __('action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $coupon)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $coupon->name }}</td>
                                        <td>{{ $coupon->code }}</td>
                                        @if ($coupon->type->value == 'Percentage')
                                            <td>
                                                <div class="badge badge-primary">{{ $coupon->type->value }}</div>
                                            </td>
                                        @else
                                            <td>
                                                <div class="badge badge-info">{{ $coupon->type->value }}</div>
                                            </td>
                                        @endif
                                        <td>{{ numberFormat($coupon->amount) }}</td>
                                        <td>{{ numberFormat($coupon->min_amount) ?? 'N/A' }}</td>
                                        <td>{{ numberFormat($coupon->max_amount) ?? 'N/A' }}</td>
                                        <td class="text-center">
                                            <div class="badge badge-info">{{ $coupon->qty }}</div>
                                        </td>
                                        @if ($coupon->qty > $coupon->used)
                                            <td class="text-center">
                                                <div class="badge badge-danger">{{ $coupon->qty - $coupon->used }}
                                                </div>
                                            </td>
                                        @else
                                            <td class="text-center">
                                                <div class="badge badge-danger">0</div>
                                            </td>
                                        @endif
                                        <td>
                                            <div class="badge badge-success">
                                                {{ dateFormat($coupon->expired_date) }}
                                            </div>
                                        </td>
                                        <td>{{ $coupon->user->name }}</td>
                                        <td>
                                            <a data-toggle="modal" data-target="#editModal" href="#"
                                                class="edit-btn btn btn-sm common-btn"
                                                data-action="{{ route('coupon.update', $coupon->id) }}"
                                                data-name="{{ $coupon->name }}" data-code="{{ $coupon->code }}"
                                                data-type="{{ $coupon->type }}" data-amount="{{ $coupon->amount }}"
                                                data-minimum_amount="{{ $coupon->min_amount }}"
                                                data-maximum_amount="{{ $coupon->max_amount }}"
                                                data-quantity="{{ $coupon->qty }}"
                                                data-expired_date="{{ $coupon->expired_at }}"><i
                                                    class="fa fa-edit"></i></a>

                                            <a id="delete" href="{{ route('coupon.destroy', $coupon->id) }}"
                                                class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="create-modal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true"
        data-backdrop="static" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header card-header-color">
                    <span id="createModalLabel" class="modal-title list-title text-white">{{ __('new_coupon') }}</span>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                            aria-hidden="true"><i class="fa fa-times text-white"></i></span></button>
                </div>
                <form action="{{ route('coupon.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label class="mb-2">{{ __('name') }} <span class="text-danger">*</span></label>
                                <input type="text" name="name" step="any" class="form-control"
                                    placeholder="{{ __('enter_your_coupon_name') }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="mb-2">{{ __('code') }} <span class="text-danger">*</span></label>
                                <input id="createCouponcode" type="text" name="code" class="form-control"
                                    placeholder="{{ __('enter_your_coupon_code') }}">
                                @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="mb-2">{{ __('type') }} <span class="text-danger">*</span></label>
                                <select class="form-control" name="type" id="couponType">
                                    <option selected disabled>{{ __('select_a_option') }}</option>
                                    @foreach ($couponTypes as $couponType)
                                        <option value="{{ $couponType->value }}">{{ $couponType->value }}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group minimum-amount mb-3">
                                <label class="mb-2">{{ __('minimum_amount') }}</label>
                                <input type="number" name="minimum_amount" step="any" class="form-control"
                                    placeholder="{{ __('enter_your_minimum_purchase_amount') }}">
                            </div>
                            <div class="col-md-6 form-group minimum-amount mb-3">
                                <label class="mb-2">{{ __('maximum_amount') }}</label>
                                <input type="number" name="maximum_amount" step="any" class="form-control"
                                    placeholder="{{ __('enter_your_maximum_purchase_amount') }}">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="mb-2">{{ __('amount') }} <span class="text-danger">*</span></label>
                                <input type="number" name="amount" class="form-control"
                                    placeholder="{{ __('enter_your_discount_amount') }}">
                                @error('amount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="mb-2">{{ __('quantity') }} <span class="text-danger">*</span></label>
                                <input type="number" name="quantity" step="any" class="form-control"
                                    placeholder="{{ __('enter_your_coupon_apply_quantity') }}">
                                @error('quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="mb-2">{{ __('expired_date') }} <span class="text-danger">*</span></label>
                                <input type="date" name="expired_date" class="form-control">
                                @error('expired_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-dipBlue bgBlue saveBtn">{{ __('submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="editModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="editModalBox"
        aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header card-header-color">
                    <span id="editModalBox" class="modal-title list-title text-white">{{ __('edit_coupon') }}</span>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                            aria-hidden="true"><i class="fa fa-times text-white"></i></span></button>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label class="mb-2">{{ __('name') }} <span class="text-danger">*</span></label>
                                <input type="text" name="name" step="any" class="form-control"
                                    placeholder="{{ __('enter_your_coupon_name') }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="mb-2">{{ __('Code') }} <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input id="editCouponcode" type="text" name="code" class="form-control"
                                        placeholder="{{ __('enter_your_coupon_code') }}">
                                </div>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="mb-2">{{ __('type') }} <span class="text-danger">*</span></label>
                                <select class="form-control" name="type">
                                    @foreach ($couponTypes as $couponType)
                                        <option value="{{ $couponType->value }}">{{ $couponType->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group minimum-amount mb-3">
                                <label class="mb-2">{{ __('minimum_amount') }} <span
                                        class="text-danger">*</span></label>
                                <input type="number" name="minimum_amount" step="any" class="form-control"
                                    placeholder="{{ __('enter_your_minimum_purchase_amount') }}">
                            </div>
                            <div class="col-md-6 form-group minimum-amount mb-3">

                                <label class="mb-2">{{ __('maximum_amount') }}</label>
                                <input type="number" name="maximum_amount" step="any" class="form-control"
                                    placeholder="{{ __('enter_your_maximum_purchase_amount') }}">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="mb-2">{{ __('amount') }} <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="number" name="amount" step="any" required class="form-control"
                                        placeholder="{{ __('enter_your_discount_amount') }}">
                                </div>
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="mb-2">{{ __('quantity') }} <span class="text-danger">*</span></label>
                                <input type="number" name="quantity" step="any" required class="form-control"
                                    placeholder="{{ __('enter_your_coupon_apply_quantity') }}">
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label class="mb-2">{{ __('expired_date') }}</label>
                                <input type="date" name="expired_date" class="expired_date form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('close') }}</button>
                        <button type="submit"
                            class="btn btn-dipBlue bgBlue saveBtn">{{ __('update_and_save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".minimum-amount").hide();
        $("#couponType").on("change", function() {
            if ($(this).val() == 'Amount') {
                $("#create-modal .minimum-amount").show();
                $("#create-modal .minimum-amount").prop('required', true);
            } else {
                $("#create-modal .minimum-amount").hide();
                $("#create-modal .minimum-amount").prop('required', false);
                $("#create-modal .icon-text").text('%');
            }
        });
        $(document).on("change", "#editModal select[name='type']", function() {
            if ($(this).val() == 'Amount') {
                $("#editModal .minimum-amount").show();
                $("#editModal .minimum-amount").prop('required', true);
            } else {
                $("#editModal .minimum-amount").hide();
                $("#editModal .minimum-amount").prop('required', false);
                $("#editModal .icon-text").text('%');
            }
        });

        $(document).on('click', '.edit-btn', function() {
            const action = $(this).attr('data-action');
            const name = $(this).attr('data-name');
            const code = $(this).attr('data-code');
            const type = $(this).attr('data-type');
            const amount = $(this).attr('data-amount');
            const minimum_amount = $(this).attr('data-minimum_amount');
            const maximum_amount = $(this).attr('data-maximum_amount');
            const quantity = $(this).attr('data-quantity');
            const expired_date = $(this).attr('data-expired_date');
            console.log(expired_date);
            $('#editForm').attr('action', action)
            $("#editModal input[name='name']").val(name);
            $("#editModal input[name='code']").val(code);
            $("#editModal select[name='type']").val(type);
            $("#editModal input[name='amount']").val(amount);
            $("#editModal input[name='minimum_amount']").val(minimum_amount);
            $("#editModal input[name='maximum_amount']").val(maximum_amount);
            $("#editModal input[name='quantity']").val(quantity);
            $("#editModal input[name='expired_date']").val(expired_date);
            if (type == 'Amount') {
                $("#editModal .minimum-amount").show();
                $("#editModal .minimum-amount").prop('required', true);
            }
        });
    </script>
@endpush
