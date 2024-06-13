@extends('layout.app')
@section('title', __('roles'))
@section('content')
    <section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span class="list-title">{{ __('roles') }}</span>
                    <button href="#" data-toggle="modal" data-target="#createModal" class="btn common-btn"><i
                            class="fa fa-plus"></i>
                        {{ __(' Add Role') }} </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table dataTable table-hover">
                            <thead class="table-bg-color">
                                <tr>
                                    <th class="not-exported">{{ __('sl') }}</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('description') }}</th>
                                    <th class="not-exported">{{ __('action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ ucfirst($role->name) }}</td>
                                        <td style="max-width: 400px; text-align:justify">
                                            {{ $role->description ?? __('no_description_available_yet') }}</td>
                                        <td class="">
                                            <a data-toggle="modal" data-target="#editeModal_{{ $role->id }}"
                                                href="#" class="btn btn-sm common-btn"><i class="fa fa-edit"></i></a>
                                            <a id="permission" href="{{ route('role.permission', $role->id) }}"
                                                class="btn btn-sm print-btn" title="Permission"><i
                                                    class="fa fa-key"></i></a>
                                        </td>
                                    </tr>
                                    <div id="editeModal_{{ $role->id }}" data-backdrop="static" tabindex="-1"
                                        role="dialog" aria-labelledby="editModalLabel" aria-hidden="true"
                                        class="modal fade text-left">
                                        <div role="document" class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form action="{{ route('role.update', $role->id) }}" method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-header card-header-color">
                                                        <span id="editModalLabel" class="list-title text-white modal-title">
                                                            {{ __('edit_role_description') }}</span>
                                                        <button type="button" data-dismiss="modal" aria-label="Close"
                                                            class="close"><span aria-hidden="true"><i
                                                                    class="fa fa-times text-white"></i></span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="role_id">
                                                        <div class="form-group">
                                                            <label class="mb-2">{{ __('description') }} <span
                                                                    class="text-danger">*</span></label>
                                                            <textarea class="form-control" name="description" placeholder="{{ __('enter_your_role_description') }}">{{ $role->description }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
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
    <div id="createModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="createModalLabel"
        aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('role.store') }}" method="POST">
                    @csrf
                    <div class="modal-header card-header-color">
                        <span class="list-title text-white modal-title" id="createModalLabel">{{ __('new_role') }}</span>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                                aria-hidden="true"><i class="fa fa-times text-white"></i></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label class="mb-2">{{ __('name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Enter your role name">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="mb-2">{{ __('description') }}</label>
                            <textarea class="form-control" name="description" placeholder="{{ __('enter_your_role_description') }}"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn common-btn">{{ __('submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
