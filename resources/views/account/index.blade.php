@extends('layout.app')
@section('title', __('accounts'))
@section('content')
    <section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span class="list-title">{{ __('accounts') }}</span>
                    <button class="btn common-btn" data-toggle="modal" data-target="#account-modal"><i class="fa fa-plus"
                            aria-hidden="true"></i>
                        {{ __('add_account') }}</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table dataTable table-hover">
                            <thead class="table-bg-color">
                                <tr>
                                    <th class="not-exported">{{ __('sl') }}</th>
                                    <th>{{ __('account_no') }}</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('balance') }}</th>
                                    <th>{{ __('note') }}</th>
                                    <th class="not-exported">{{ __('action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $account)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $account->account_no }}</td>
                                        <td>{{ $account->name }}</td>
                                        @if ($account->total_balance)
                                            <td>{{ numberFormat($account->total_balance ?? 0.0) }}</td>
                                        @endif
                                        <td>{{ $account->note ?? 'N/A' }}</td>
                                        <td>
                                            <a data-toggle="modal" data-target="#addMoney_{{ $account->id }}"
                                                href="#" class="btn btn-sm common-btn mb-2"><i
                                                    class="fa fa-plus-circle"></i></a>

                                            <a data-toggle="modal" data-target="#editModal" href="#"
                                                class="edit-btn btn btn-sm common-btn mb-2"
                                                data-action="{{ route('account.update', $account->id) }}"
                                                data-account-no="{{ $account->account_no }}"
                                                data-name="{{ $account->name }}" data-note="{{ $account->note }}"><i
                                                    class="fa fa-edit"></i></a>

                                            <a id="delete" href="{{ route('account.destroy', $account->id) }}"
                                                class="btn btn-sm btn-danger mb-2"><i class="fa fa-trash"></i></a>

                                        </td>
                                    </tr>
                                    <div id="addMoney_{{ $account->id }}" tabindex="-1" role="dialog"
                                        data-backdrop="static" aria-labelledby="accountModal" aria-hidden="true"
                                        class="modal fade text-left">
                                        <div role="document" class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form action="{{ route('account.update.balance', $account->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="modal-header card-header-color">
                                                        <span id="accountModal" class="modal-title list-title text-white">
                                                            {{ __('deposit_balance') }}</span>
                                                        <button type="button" data-dismiss="modal" aria-label="Close"
                                                            class="close"><span aria-hidden="true"><i
                                                                    class="fa fa-times text-white"></i></span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label
                                                                        class="mb-2">{{ __('available_balance') }}</label>
                                                                    <input type="text" class="form-control mb-2"
                                                                        value="{{ numberFormat($account->total_balance) }}"
                                                                        readonly>
                                                                    <span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="mb-2">{{ __('balance') }}</label>
                                                                    <input type="number" name="total_balance"
                                                                        placeholder="{{ __('enter_your_deposit_balance') }}"
                                                                        step="any" class="form-control">
                                                                    @error('total_balance')
                                                                        <span
                                                                            class="text-danger">{{ __('enter_deposit_amount') }}</span>
                                                                    @enderror
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
    <!-- account modal -->
    <div id="account-modal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel"
        aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('account.store') }}" method="POST">
                    @csrf
                    <div class="modal-header card-header-color">
                        <span id="exampleModalLabel"
                            class="modal-title list-title text-white">{{ __('new_account') }}</span>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                                aria-hidden="true"><i class="fa fa-times text-white"></i></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-2">{{ __('name') }}<span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control mb-2"
                                        placeholder="{{ __('enter_your_account_name') }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-2">{{ __('account_no') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="account_no" class="form-control mb-2"
                                        placeholder="{{ __('enter_your_account_no') }}">
                                    @error('account_no')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-2">{{ __('balance') }}<span class="text-danger">*</span></label>
                                    <input type="number" name="balance" step="any" class="form-control mb-2"
                                        placeholder="{{ __('enter_your_current_balance') }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="mb-2">{{ __('note') }}</label>
                                    <textarea name="note" rows="3" class="form-control" placeholder="{{ __('enter_your_note') }}"></textarea>
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
    <!-- end account modal -->
    <!-- start account edit modal -->
    <div id="editModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="accountModal"
        aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="accountEdit" method="POST">
                    @csrf
                    <div class="modal-header card-header-color">
                        <span id="accountModal"
                            class="modal-title list-title text-white">{{ __('edit_account_info') }}</span>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                                aria-hidden="true"><i class="fa fa-times text-white"></i></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-2">{{ __('name') }}<span class="text-danger">*</span></label>
                                    <input type="text" id="editName" name="name" required
                                        class="form-control mb-2" placeholder="{{ __('enter_your_account_name') }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-2">{{ __('account_no') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="editAccountNo" name="account_no" class="form-control mb-2"
                                        placeholder="{{ __('enter_your_account_no') }}">
                                    @error('account_no')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-2">{{ __('note') }}</label>
                                    <textarea name="note" id="editNote" rows="3" class="form-control"
                                        placeholder="{{ __('enter_your_note') }}"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('close') }}</button>
                        <button type="submit" class="btn common-btn">{{ __('update_and_save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('.edit-btn').on("click", function() {
            const action = $(this).attr('data-action');
            const accountNo = $(this).attr('data-account-no');
            const name = $(this).attr('data-name');
            const note = $(this).attr('data-note');

            $('#accountEdit').attr('action', action);
            $('#editName').val(name);
            $('#editAccountNo').val(accountNo);
            $('#editNote').val(note);
        });
    </script>
@endpush
