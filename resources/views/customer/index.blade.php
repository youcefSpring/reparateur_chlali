@extends('layout.app')
@section('title', __('customers'))
@section('content')
    <section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span class="list-title">{{ __('customers') }}</span>
                    <div>
                        <button type="button" class="btn import-btn" data-toggle="modal" data-target="#createImportModal"><i
                                class="fa fa-file-import"></i>&nbsp;&nbsp;{{ __('import') }}</button>
                        @can('customer.create')
                            <a href="{{ route('customer.create') }}" class="btn common-btn"><i class="fa fa-plus"></i>
                                {{ __('add_customer') }}</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table dataTable table-hover">
                            <thead class="table-bg-color">
                                <tr>
                                    <th class="not-exported">{{ __('sl') }}</th>
                                    <th>{{ __('group') }}</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('company_name') }}</th>
                                    <th>{{ __('email') }}</th>
                                    <th>{{ __('phone_number') }}</th>
                                    <th>{{ __('tax_number') }}</th>
                                    <th class="not-exported">{{ __('action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $customer->customerGroup->name ?? 'N/A' }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->company_name ?? 'N/A' }}</td>
                                        <td>{{ $customer->email ?? 'N/A' }}</td>
                                        <td>{{ $customer->phone_number }}</td>
                                        <td>{{ $customer->tax_no ?? 'N/A' }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn common-btn py-0 px-1" href="#" role="button"
                                                    id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="fa fa-ellipsis-h"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    @can('customer.edit')
                                                        <a href="{{ route('customer.edit', $customer->id) }}"
                                                            class="dropdown-item"><i class="fa fa-edit text-primary"></i>
                                                            {{ __('edit') }}</a>
                                                    @endcan
                                                    @can('customer.destroy')
                                                        <a id="delete" href="{{ route('customer.destroy', $customer->id) }}"
                                                            class="dropdown-item"><i class="fa fa-trash text-danger"></i>
                                                            {{ __('delete') }}</a>
                                                    @endcan
                                                </div>
                                            </div>
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
    <!-- import modal -->
    <div id="createImportModal" tabindex="-1" role="dialog" data-backdrop="static"
        aria-labelledby="categoryEditModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('customer.import') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header card-header-color">
                        <span id="categoryEditModalLabel"
                            class="modal-title list-title text-white">{{ __('import_customer') }}</span>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"
                            onclick="modalClose()"><span aria-hidden="true"><i
                                    class="fa fa-times text-white"></i></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="mb-2">{{ __('import') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="customerEditName"
                                        placeholder="{{ __('enter_your_customer_name') }}" name="file">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <a href="{{ route('download.customer.sample') }}"
                                    class="btn common-btn w-100">{{ __('download') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            onclick="modalClose()">{{ __('close') }}</button>
                        <button type="submit" class="btn common-btn">{{ __('import') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
