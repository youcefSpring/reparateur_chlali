@extends('layout.app')
@section('title', __('customer_groups'))
@section('content')
    <section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span class="list-title">{{ __('customer_groups') }}</span>
                    <button class="btn common-btn" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus"></i>
                        {{ __('add_customer_group') }} </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table dataTable table-hover" style="width: 100%">
                            <thead class="table-bg-color">
                                <tr>
                                    <th class="not-exported">{{ __('sl') }}</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('percentage') }}</th>
                                    <th class="not-exported">{{ __('action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customerGroups as $customer_group)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $customer_group->name }}</td>
                                        <td>{{ $customer_group->percentage }}</td>
                                        <td class="">
                                            <a data-toggle="modal" data-target="#editeModal"
                                                data-action="{{ route('customer.group.update', $customer_group->id) }}"
                                                data-name="{{ $customer_group->name }}"
                                                data-percentage="{{ $customer_group->percentage }}" href="#"
                                                class="btn btn-sm common-btn edit-btn"><i class="fa fa-edit"></i></a>
                                            <a id="delete"
                                                href="{{ route('customer.group.delete', $customer_group->id) }}"
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
    <div id="createModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel"
        aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('customer.group.store') }}" method="POST">
                    @csrf
                    <div class="modal-header card-header-color">
                        <span id="exampleModalLabel"
                            class="modal-title list-title text-white">{{ __('new_customer_group') }}</span>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                                aria-hidden="true"><i class="fa fa-times text-white"></i></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="mb-2">{{ __('name') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control"
                                        placeholder="{{ __('enter_your_customer_group_name') }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-2">{{ __('discount_percentage') }} (%) <span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="percentage" class="form-control"
                                        placeholder="{{ __('enter_your_discount_percentage') }}">
                                    @error('percentage')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
    <div id="editeModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel"
        aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="editForm" method="POST">
                    @csrf
                    <div class="modal-header card-header-color">
                        <span id="exampleModalLabel" class="modal-title list-title text-white">
                            {{ __('edit_customer_group') }}
                        </span>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                                aria-hidden="true"><i class="fa fa-times text-white"></i></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="mb-2">{{ __('name') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="{{ __('enter_your_customer_group_name') }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-2">{{ __('discount_percentage') }} (%) <span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="percentage" class="form-control" id="percentage"
                                        placeholder="{{ __('enter_your_discount_percentage') }}">
                                    @error('percentage')
                                        <span class="text-danger">{{ $message }}</span>
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
@endsection
@push('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('click', '.edit-btn', function() {
            const action = $(this).attr('data-action');
            const name = $(this).attr('data-name');
            const percentage = $(this).attr('data-percentage');
            $("#editForm").attr('action', action);
            $("#name").val(name);
            $("#percentage").val(percentage);
        });
    </script>
@endpush
