@extends('layout.app')
@section('title', __('departments'))
@section('content')
    <section>
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <span class="list-title">{{ __('departments') }}</span>
                <div>
                    <button type="button" class="btn common-btn" data-toggle="modal" data-target="#createModal"><i
                            class="fa fa-plus"></i>&nbsp;&nbsp;{{ __('add_department') }}</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover dataTable" style="width: 100%">
                        <thead class="table-bg-color">
                            <tr>
                                <th>{{ __('sl') }}</th>
                                <th>{{ __('name') }}</th>
                                <th class="not-exported">{{ __('action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($departments as $department)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $department->name }}</td>
                                    <td>
                                        <a data-action="{{ route('department.update', $department->id) }}"
                                            data-name="{{ $department->name }}"
                                            class="departmentEditBtn btn btn-sm common-btn text-white"><i
                                                class="fa fa-edit"></i></a>
                                        <a id="delete" href="{{ route('department.delete', $department->id) }}"
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
    <div id="createModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="departmentCreateModal"
        aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('department.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header card-header-color">
                        <span id="departmentCreateModal"
                            class="modal-title list-title text-white">{{ __('new_department') }}</span>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                                aria-hidden="true"><i class="fa fa-times text-white"></i></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col-md-12 mb-3">
                                <x-input name="name" title="{{ __('name') }}"
                                    placeholder="{{ __('enter_your_department_name') }}" />
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
    <!-- Edit Modal -->
    <div id="departmentEditModal" tabindex="-1" role="dialog" data-backdrop="static"
        aria-labelledby="departmentEditModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="departmentEditForm" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="modal-header card-header-color">
                        <span id="departmentEditModalLabel"
                            class="modal-title list-title text-white">{{ __('edit_department') }}</span>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"
                            onclick="modalClose()"><span aria-hidden="true"><i
                                    class="fa fa-times text-white"></i></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="mb-2">{{ __('name') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="departmentEditName"
                                        placeholder="{{ __('enter_your_department_name') }}" name="name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"
                            onclick="modalClose()">{{ __('close') }}</button>
                        <button type="submit" class="btn common-btn">{{ __('update_and_save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).on('click', '.departmentEditBtn', function(e) {
            e.preventDefault();
            $('#departmentEditModal').modal('show');
            const action = $(this).attr('data-action');
            const name = $(this).attr('data-name');

            $('#departmentEditForm').attr('action', action)
            $('#departmentEditName').val(name)
        });

        function modalClose() {
            $('#departmentEditModal').modal('hide');
        }
        $(document).on('click', '.departmentDeleteBtn', function(e) {
            const route = $(this).attr('data-action');
            confirmDelete(route)
        });
    </script>
@endpush
