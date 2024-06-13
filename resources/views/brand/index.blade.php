@extends('layout.app')
@section('title', __('brands'))
@section('content')
    <section>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span class="list-title">{{ __('brands') }}</span>
                    <button class="btn common-btn" data-toggle="modal" data-target="#createModal"><i
                            class="fa fa-plus"></i>&nbsp;&nbsp;
                        {{ __('add_brand') }}</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table dataTable table-hover" style="width: 100%">
                            <thead class="table-bg-color">
                                <tr>
                                    <th class="not-exported">{{ __('sl') }}</th>
                                    <th>{{ __('image') }}</th>
                                    <th>{{ __('brand') }}</th>
                                    <th class="not-exported">{{ __('action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $key => $brand)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td> <img src="{{ $brand->thumbnail->file }}" height="30" width="30"></td>
                                        <td>{{ $brand->title }}</td>
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#brandEditModal"
                                                data-action="{{ route('brand.update', $brand->id) }}"
                                                data-title="{{ $brand->title }}" data-image="{{ $brand->thumbnail_id }}"
                                                class="btn btn-sm common-btn edit-btn"><i class="fa fa-edit"></i></a>
                                            <a id="delete" href="{{ route('brand.delete', $brand->id) }}"
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
                <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header card-header-color">
                        <span id="exampleModalLabel" class="modal-title list-title text-white">{{ __('new_brand') }}</span>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                                aria-hidden="true"><i class="fa fa-times text-white"></i></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-group">
                                    <label class="mb-2">{{ __('title') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control"
                                        placeholder="{{ __('enter_your_brand_title') }}">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-2">{{ __('image') }} <span class="text-danger">*</span></label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('close') }}</button>
                        <button type="submit"class="btn common-btn">{{ __('submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="brandEditModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="BrandModalLabel"
        aria-hidden="true" class="modal fade text-left">
        <div role="document" class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="BrandUpdate" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="modal-header card-header-color">
                        <span id="BrandModalLabel" class="modal-title list-title text-white">{{ __('edit_brand') }}</span>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                                aria-hidden="true"><i class="fa fa-times text-white"></i></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-2">{{ __('title') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="title" id="brandTitle" class="form-control"
                                        placeholder="{{ __('enter_your_brand_title') }}">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="mb-2">{{ __('image') }}</label>
                                    <input type="file" name="image" class="form-control">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(document).on('click', '.edit-btn', function() {
            const action = $(this).attr('data-action');
            const title = $(this).attr('data-title');
            const image = $(this).attr('data-image');
            $('#BrandUpdate').attr('action', action);
            $('#brandTitle').val(title);
            $('#showImg').val(image);
        });
    </script>
@endpush
