@extends('admin.admin_master')
@section('admin')
    <section class="content-main">
        <div class="content-header">
            <h2 class="content-title">Page Add</h2>
            <div class="">
                <a href="{{ route('page.index') }}" class="btn btn-primary"><i class="material-icons md-list"></i> Page
                    List</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" action="{{ route('page.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="name_en" class="col-form-label" style="font-weight: bold;"> Name
                                            (English)*:</label>
                                        <input class="form-control" id="name_en" type="text" name="name_en"
                                            placeholder="Write page name english" required=""
                                            value="{{ old('name_en') }}">
                                        @error('name_en')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="name_bn" class="col-form-label" style="font-weight: bold;"> Name
                                            (Bangla):</label>
                                        <input class="form-control" id="name_bn" type="text" name="name_bn"
                                            placeholder="Write page name bangla" value="{{ old('name_bn') }}">
                                    </div>
                                    <div class="mb-4">
                                        <label for="title" class="col-form-label" style="font-weight: bold;">
                                            Title:</label>
                                        <input class="form-control" id="title" type="text" name="title"
                                            placeholder="Write page title" value="{{ old('title') }}">
                                    </div>
                                    <div class="mb-4">
                                        <label for="description_en" class="col-form-label"
                                            style="font-weight: bold;">Description (English):</label>
                                        <textarea name="description_en" id="description_en" cols="5" placeholder="Write page description english"
                                            class="form-control summernote">{{ old('description_en') }}</textarea>
                                        @error('description_en')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="description_bn" class="col-form-label"
                                            style="font-weight: bold;">Description (Bangla):</label>
                                        <textarea name="description_bn" id="description_bn" cols="5" placeholder="Write page description bangla"
                                            class="form-control summernote">{{ old('description_bn') }}</textarea>
                                    </div>

                                    <div class="mb-4">
                                        <label for="position" class="col-form-label" style="font-weight: bold;">
                                            Position:</label>
                                        <div class="custom_select">
                                            <select class="form-control select-active w-100 form-select select-nice"
                                                name="position">
                                                <option value="Nav">Nav</option>
                                                <option value="Bottom">Bottom</option>
                                                <option value="Both">Both</option>
                                            </select>
                                            @error('position')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="form-check-input me-2 cursor" name="status"
                                                id="status" checked value="1">
                                            <label class="form-check-label cursor" for="status">Status</label>
                                        </div>
                                    </div>

                                    <div class="row mb-4 justify-content-sm-end">
                                        <div class="col-lg-3 col-md-4 col-sm-5 col-6">
                                            <input type="submit" class="btn btn-primary" value="Submit">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- .row // -->
                    </div>
                    <!-- card body .// -->
                </div>
                <!-- card .// -->
            </div>
        </div>
    </section>
@endsection
