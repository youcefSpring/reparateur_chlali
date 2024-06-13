@extends('layout.app')
@section('title', __('add_language'))
@section('content')
    <div class="container-fluid my-4">
        <div class="row">
            <div class="col-lg-7 mt-2 mx-auto ">
                <form action="{{ route('language.store') }}" method="POST">
                    @csrf
                    <div class="card border-0 shadow-sm">
                        <div class="card-header">
                            <h3 class="m-0">{{ __('create_new_language') }}</h3>
                        </div>
                        <div class="card-body">
                            <div>
                                <x-input type="text" name="title" placeholder="{{ __('enter_your_language_title') }}"
                                    title="{{ __('title') }}" value="" />
                            </div>
                            <div class="mt-3">
                                <label class="mb-0">{{ __('short_name') }}
                                    <small>({{ __('only_allow_english_characters') }})</small></label>
                                <input name="name" oninput="this.value=this.value.replace(/[^a-z]/gi,'')"
                                    class="form-control" placeholder="{{ __('example') }}: bn" autocomplete="off"
                                    required />
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between flex-wrap gap-2 ">
                            <a href="{{ route('language.index') }}" class="btn btn-danger">{{ __('back') }}</a>
                            <button type="submit" class="btn common-btn">{{ __('submit') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection