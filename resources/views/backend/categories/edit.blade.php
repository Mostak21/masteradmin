@extends('backend.layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-8 mx-auto text-left">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">Edit Category Information</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('categories.update',$category->id) }}" method="Post" enctype="multipart/form-data">
                        <input name="_method" type="hidden" value="PATCH">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Name</label>
                            <div class="col-md-9">
                                <input type="text" placeholder="Name" id="name" name="name" class="form-control" value="{{$category->name}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Parent Category</label>
                            <div class="col-md-9">
                                <select class="select2 form-control rit-selectpicker" name="parent_id" data-toggle="select2" data-placeholder="Choose ..."data-live-search="true" data-selected="{{ $category->parent_id }}">
                                    <option value="0">No Parent</option>
                                    @foreach ($categories as $acategory)
                                        <option value="{{ $acategory->id }}">{{ $acategory->name }}</option>
                                        @foreach ($acategory->childrenCategories as $childCategory)
                                            @include('categories.child_category', ['child_category' => $childCategory])
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">
                                Ordering Number
                            </label>
                            <div class="col-md-9">
                                <input type="number"  class="form-control" id="order" name="order" placeholder="Order Level" value="{{$category->order}}">
                                <small>Higher number has high priority</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="signinSrEmail">Banner <small>(200x200)</small></label>
                            <div class="col-md-9">
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                    </div>
                                    <div class="form-control file-amount">Choose File</div>
                                    <input type="hidden" name="banner" class="selected-files" value="{{$category->banner}}">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="signinSrEmail">Icon <small>(32x32)</small></label>
                            <div class="col-md-9">
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                    </div>
                                    <div class="form-control file-amount">Choose File</div>
                                    <input type="hidden" name="icon" class="selected-files" value="{{$category->icon}}">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label" for="signinSrEmail">App Icon <small>(64x64)</small></label>
                            <div class="col-md-9">
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                    </div>
                                    <div class="form-control file-amount">Choose File</div>
                                    <input type="hidden" name="bgmenu" class="selected-files" value="{{$category->bg_menu}}">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Meta Title</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="meta_title" placeholder="Meta Title" value="{{$category->meta_title}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Meta Description</label>
                            <div class="col-md-9">
                                <textarea name="meta_description" rows="5" class="form-control" >{{$category->meta_description}}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Slug</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="slug" placeholder="slug" value="{{$category->slug}}" required>

                            </div>
                        </div>



                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
