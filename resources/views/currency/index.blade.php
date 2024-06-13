@extends('layout.app')
@section('title', __('currencies'))
@section('content')
    <section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span class="list-title">{{ __('currencies') }}</span>
                    <button class="btn common-btn" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus"></i>
                        {{ __('add_currency') }}</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table dataTable table-hover" style="width: 100%">
                            <thead class="table-bg-color">
                                <tr>
                                    <th class="not-exported">{{ __('sl') }}</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('symbol') }}</th>
                                    <th>{{ __('code') }}</th>
                                    <th class="not-exported">{{ __('action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($currencies as $currency)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $currency->name }}</td>
                                        <td>{{ $currency->symbol }}</td>
                                        <td>{{ $currency->code }}</td>
                                        <td>
                                            <a data-toggle="modal" data-target="#editeModal_{{ $currency->id }}"
                                                href="#" class="btn btn-sm common-btn"><i class="fa fa-edit"></i></a>

                                            <a id="delete" href="{{ route('currency.delete', $currency->id) }}"
                                                class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <div id="editeModal_{{ $currency->id }}" tabindex="-1" role="dialog"
                                        data-backdrop="static" aria-labelledby="editModalLabel" aria-hidden="true"
                                        class="modal fade text-left">
                                        <div role="document" class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form action="{{ route('currency.update', $currency->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="modal-header card-header-color">
                                                        <span id="editModalLabel" class="modal-title list-title text-white">
                                                            {{ __('edit_currency') }}
                                                        </span>
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
                                                                        placeholder="{{ __('enter_your_currency_name') }}"
                                                                        value="{{ $currency->name }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label
                                                                        class="mb-2">{{ __('symbol') }}
                                                                        <span class="text-danger">*</span></label>
                                                                    <input type="text" name="symbol"
                                                                        class="form-control mb-2"
                                                                        placeholder="{{ __('Enter_your_currency_symbol') }}"
                                                                        value="{{ $currency->symbol }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="mb-2">{{ __('code') }}
                                                                        <span class="text-danger">*</span></label>
                                                                    <input type="text" name="code"
                                                                        class="form-control"
                                                                        placeholder="{{ __('enter_your_currency_code') }}"
                                                                        value="{{ $currency->code }}">
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
                <form action="{{ route('currency.store') }}" method="POST">
                    @csrf
                    <div class="modal-header card-header-color">
                        <span id="createModalLabel"
                            class="modal-title list-title text-white">{{ __('new_currency') }}</span>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                                aria-hidden="true"><i class="fa fa-times text-white"></i></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-2">{{ __('name') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control mb-2"
                                        placeholder="{{ __('enter_your_currency_name') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-2">{{ __('symbol') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="symbol" class="form-control mb-2"
                                        placeholder="{{ __('Enter_your_currency_symbol') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-2">{{ __('code') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="code" class="form-control"
                                        placeholder="{{ __('enter_your_currency_code') }}">
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
