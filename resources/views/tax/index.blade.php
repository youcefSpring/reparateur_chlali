@extends('layout.app')
@section('title', __('taxs'))
@section('content')
    <section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span class="list-title">{{ __('taxs') }}</span>
                    <button href="#" data-toggle="modal" data-target="#createModal" class="btn common-btn"><i
                            class="fa fa-plus"></i>
                        {{ __('add_tax') }}</button>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table dataTable table-hover" style="width: 100%">
                            <thead class="table-bg-color">
                                <tr>
                                    <th class="not-exported">{{ __('sl') }}</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('rate') }} (%)</th>
                                    <th class="not-exported">{{ __('action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($taxs as $tax)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $tax->name }}</td>
                                        <td>{{ $tax->rate }}</td>
                                        <td class="">
                                            <a data-toggle="modal" data-target="#editeModal_{{ $tax->id }}"
                                                href="#" class="btn btn-sm common-btn"><i class="fa fa-edit"></i></a>
                                            <a id="delete" href="{{ route('tax.delete', $tax->id) }}"
                                                class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <div id="editeModal_{{ $tax->id }}" data-backdrop="static" tabindex="-1"
                                        role="dialog" aria-hidden="true" class="modal fade text-left">
                                        <div role="document" class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form action="{{ route('tax.update', $tax->id) }}" method="post">
                                                    @csrf
                                                    <div class="modal-header card-header-color">
                                                        <h5 id="editModalLabel" class="modal-title list-title text-white">
                                                            {{ __('edit_tax') }}</h5>
                                                        <button type="button" data-dismiss="modal" aria-label="Close"
                                                            class="close"><span aria-hidden="true"><i
                                                                    class="fa fa-times text-white"></i></span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="mb-2">{{ __('name') }}
                                                                        <span class="text-danger">*</span></label>
                                                                    <input type="text" name="name"
                                                                        class="form-control mb-2"
                                                                        placeholder="{{ __('enter_your_tax_name') }}"
                                                                        value="{{ $tax->name }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="mb-2">{{ __('rate') }}
                                                                        (%) <span class="text-danger">*</span></label>
                                                                    <input type="number" name="rate"
                                                                        placeholder="{{ __('enter_your_tax_rate') }}"
                                                                        value="{{ $tax->rate }}" class="form-control"
                                                                        required>
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

    <div id="createModal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true"
        class="modal fade text-left">
        <div role="document" class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('tax.store') }}" method="post">
                    @csrf
                    <div class="modal-header card-header-color">
                        <span id="createModalLabel"
                            class="modal-title list-title text-white">{{ __('new_tax') }}</span>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                                aria-hidden="true"><i class="fa fa-times text-white"></i></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-2">{{ __('name') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="name"
                                        placeholder="{{ __('enter_your_tax_name') }}"
                                        class="form-control mb-2" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-2">{{ __('rate') }} (%) <span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="rate"
                                        placeholder="{{ __('enter_your_tax_rate') }}"
                                        class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('close') }}</button>
                        <button type="submit"
                            class="btn common-btn">{{ __('submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    @if ($errors->all())
        <script>
            Toast.fire({
                icon: 'error',
                title: "Fill in all required fields"
            })
        </script>
    @endif
@endpush
