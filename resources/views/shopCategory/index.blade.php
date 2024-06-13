@extends('layout.app')
@section('title', __('shop_categories'))
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #29aae1;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #29aae1;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    .primary_color {
        position: relative;
        display: inline-block;
        width: 35px !important;
        height: 35px;
    }
</style>
@section('content')
    <section>
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <span class="list-title">{{ __('shop_categories') }}</span>
                <div>
                    <button type="button" class="btn common-btn" data-toggle="modal" data-target="#createModal"><i
                            class="fa fa-plus"></i>&nbsp;&nbsp;{{ __('add_shop_category') }}</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-hover dataTable" style="width: 100%">
                        <thead class="table-bg-color">
                            <tr>
                                <th>{{ __('sl') }}</th>
                                <th>{{ __('name') }}</th>
                                <th>{{ __('primary_color') }}</th>
                                <th>{{ __('secondary_color') }}</th>
                                <th>{{ __('description') }}</th>
                                <th>{{ __('status') }}</th>
                                <th class="not-exported">{{ __('action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shopCategories as $shopCategory)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $shopCategory->name }}</td>
                                    <td>
                                        <span class="primary_color"
                                            style="background: {{ $shopCategory->primary_color }}"></span>
                                    </td>
                                    <td>
                                        <span class="primary_color"
                                            style="background: {{ $shopCategory->secondary_color }}"></span>
                                    </td>
                                    <td>{{ $shopCategory->description ?? 'N/A' }}</td>
                                    <td>
                                        <label class="switch">
                                            <input type="checkbox" class="subscriptionStatus"
                                                data-id="{{ $shopCategory->id }}"
                                                {{ $shopCategory->status->value == 'Active' ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <a data-action="{{ route('shop.category.update', $shopCategory->id) }}"
                                            data-name="{{ $shopCategory->name }}"
                                            data-description="{{ $shopCategory->description }}"
                                            data-status="{{ $shopCategory->status->value }}"
                                            data-primary-color="{{ $shopCategory->primary_color }}"
                                            data-secondary-color="{{ $shopCategory->secondary_color }}"
                                            class="shopCategoryEditBtn btn btn-sm common-btn text-white"><i
                                                class="fa fa-edit"></i></a>
                                        <a id="delete" href="{{ route('shop.category.delete', $shopCategory->id) }}"
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
    <div id="createModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="shopCategoryCreateModal"
        aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('shop.category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header card-header-color">
                        <span id="categoryCreateModal"
                            class="modal-title list-title text-white">{{ __('new_shop_category') }}</span>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                                aria-hidden="true"><i class="fa fa-times text-white"></i></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col-md-12 mb-3">
                                <x-input name="name" title="{{ __('name') }}"
                                    placeholder="{{ __('enter_your_shop_category_name') }}" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <x-input type="color" name="primary_color" title="{{ __('primary_color') }}" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <x-input type="color" name="secondary_color" title="{{ __('secondary_color') }}" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="mb-2">{{ __('description') }}</label>
                                <textarea name="description" class="form-control" rows="3"
                                    placeholder="{{ __('enter_your_shop_category_description') }}"></textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <x-select name="status" title="{{ __('status') }}"
                                    placeholder="{{ __('select_a_option') }}">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->value }}">
                                            {{ $status->value }}
                                        </option>
                                    @endforeach
                                </x-select>
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
    <div id="shopCategoryEditModal" tabindex="-1" role="dialog" data-backdrop="static"
        aria-labelledby="shopCategoryEditModalLabel" aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="shopCategoryEditForm" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="modal-header card-header-color">
                        <span id="shopCategoryEditModalLabel"
                            class="modal-title list-title text-white">{{ __('edit_shop_category') }}</span>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"
                            onclick="modalClose()"><span aria-hidden="true"><i
                                    class="fa fa-times text-white"></i></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="mb-2">{{ __('name') }}<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="shopCategoryEditName"
                                        placeholder="{{ __('enter_your_shop_category_name') }}" name="name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="mb-2">{{ __('primary_color') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="color" class="form-control" id="shopCategoryEditprimaryColor"
                                        name="primary_color">
                                    @error('primary_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="mb-2">{{ __('secondary_color') }}<span
                                            class="text-danger">*</span></label>
                                    <input type="color" class="form-control" id="shopCategoryEditSecondaryColor"
                                        name="secondary_color">
                                    @error('secondary_color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="mb-2">{{ __('description') }}</label>
                                <textarea name="description" class="form-control" id="shopCategoryEditDescription" rows="3"
                                    placeholder="{{ __('enter_your_shop_category_description') }}"></textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <x-select name="status" title="{{ __('status') }}"
                                    id="{{ 'shopCategoryEditStatus' }}" placeholder="{{ __('select_a_option') }}">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->value }}">
                                            {{ $status->value }}
                                        </option>
                                    @endforeach
                                </x-select>
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
        $(document).on('click', '.shopCategoryEditBtn', function(e) {
            e.preventDefault();
            $('#shopCategoryEditModal').modal('show');
            const action = $(this).attr('data-action');
            const name = $(this).attr('data-name');
            const description = $(this).attr('data-description');
            const status = $(this).attr('data-status');
            const primaryColor = $(this).attr('data-primary-color');
            const secondaryColor = $(this).attr('data-secondary-color');
           

            $('#shopCategoryEditForm').attr('action', action)
            $('#shopCategoryEditName').val(name)
            $('#shopCategoryEditprimaryColor').val(primaryColor)
            $('#shopCategoryEditSecondaryColor').val(secondaryColor)
            $('#shopCategoryEditDescription').val(description)
            $('#shopCategoryEditStatus').val(status).trigger('change')
        });

        function modalClose() {
            $('#shopCategoryEditModal').modal('hide');
        }
        $(document).on('click', '.shopCategoryDeleteBtn', function(e) {
            const route = $(this).attr('data-action');
            confirmDelete(route)
        });
        $('.subscriptionStatus').on("change", function() {
            const id = $(this).attr('data-id')
            const url = "{{ url('shop-category/status-chanage/') }}";
            if ($(this).is(":checked")) {
                window.location.href = url + '/' + id + '/Active';
            } else {
                window.location.href = url + '/' + id + '/Inactive';
            }
        });
    </script>
@endpush
