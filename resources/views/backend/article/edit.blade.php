@extends('backend.layouts.app')

@section('content')

    <div class="rit-titlebar text-left mt-2 mb-3">
        <h5 class="mb-0 h6">Add new article</h5>
    </div>
    <div class="">
        <form class="form form-horizontal mar-top" action="{{route('articles.update',$article->id)}}" method="POST" enctype="multipart/form-data" id="choice_form">
            @csrf
            <input name="_method" type="hidden" value="PATCH">
            <div class="row gutters-5">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">Article Body</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">Title<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="title" placeholder="This is the month of..." value="{{$article->title}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">Category <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <select class="select2 text-left float-left  form-control rit-selectpicker" name="category_id" data-toggle="select2" data-selected="{{ $article->category_id }}" data-placeholder="Choose ..." data-live-search="true">
                                        <option value="0">Select category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">name</option>
                                            @foreach ($category->childrenCategories as $childCategory)
                                                @include('categories.child_category', ['child_category' => $childCategory])
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">Body <span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <textarea class="rit-text-editor" name="body">{{$article->body}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" >Thumbnail <small>(200x200)</small></label>
                                <div class="col-md-8">
                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                        </div>
                                        <div class="form-control file-amount">Choose File</div>
                                        <input type="hidden" name="thumbnail" value="{{ $article->thumbnail }}" class="selected-files">
                                    </div>
                                    <div class="file-preview box sm">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">Tags<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control rit-tag-input" name="tags[]"value="{{ $article->tags }}" placeholder="Type and hit enter to add a tag" required>
                                    <small class="text-muted">This is used for search. Input those words by which user can find this article.</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">Slug<span class="text-danger">*</span></label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="slug" value="{{ $article->slug }}" required>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">Articles videos</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">Video Provider</label>
                                <div class="col-md-8">
                                    <select class="form-control rit-selectpicker" name="video_provider" data-selected="{{ $article->video_provider }}" id="video_provider">
                                        <option value="youtube">Youtube</option>
                                        <option value="dailymotion">Dailymotion</option>
                                        <option value="vimeo">Vimeo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-from-label">Video Link</label>
                                <div class="col-md-8">
                                    <input type="url" class="form-control" name="video_link" placeholder="Video Link" value="{{$article->video_link}}">
                                    <small class="text-muted">Use proper link without extra parameter. Don't use short share link/embeded iframe code.</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" for="signinSrEmail">Attached Documents </label>
                                <div class="col-md-8">
                                    <div class="input-group" data-toggle="aizuploader" data-type="document" data-multiple="true">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text bg-soft-secondary font-weight-medium">Browse</div>
                                        </div>
                                        <div class="form-control file-amount">Choose File</div>
                                        <input type="hidden" name="file" value="{{ $article->file }}" class="selected-files">
                                    </div>
                                    <div class="file-preview box sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!--col-end-->
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">
                                Article type
                            </h5>
                        </div>

                        <div class="card-body">

                            <div class="form-group row">
                                <label class="col-md-6 col-from-label">Breaking</label>
                                <div class="col-md-6">
                                    <label class="rit-switch rit-switch-success mb-0">
                                        <input type="checkbox" name="breaking" value="1" @if($article->breaking)checked=""@endif>
                                        <span></span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-6 col-from-label">Featured</label>
                                <div class="col-md-6">
                                    <label class="rit-switch rit-switch-success mb-0">
                                        <input type="checkbox" name="featured" value="1" @if($article->featured)checked=""@endif >
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">
                                Article Status
                            </h5>
                        </div>

                        <div class="card-body">

                            <div class="form-group row">
                                <label class="col-md-6 col-from-label">Publish</label>
                                <div class="col-md-6">
                                    <label class="rit-switch rit-switch-success mb-0">
                                        <input type="checkbox" name="status" value="1" @if($article->status)checked=""@endif>
                                        <span></span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-6 col-from-label">Draft</label>
                                <div class="col-md-6">
                                    <label class="rit-switch rit-switch-success mb-0">
                                        <input type="checkbox" name="draft" value="1" @if($article->draft) checked @endif>
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0 h6">
                                Aria / Location
                            </h5>
                        </div>

                        <div class="card-body">

                            <div class="form-group row" id="brand">
                                <label class="col-md-12 col-from-label">District</label>
                                <div class="col-md-12">
                                    <select class="form-control rit-selectpicker"  name="district_id" data-selected="{{ $article->district_id }}" data-live-search="true">
                                        <option value="">Select district</option>
                                        @foreach (\App\Models\District::all() as $district)
                                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row" id="brand">
                                <label class="col-md-12 col-from-label">Subdistrict/Upazilla</label>
                                <div class="col-md-12">
                                    <select class="form-control rit-selectpicker" name="subdistrict_id"  data-selected="{{ $article->subdistrict_id }}" data-live-search="true">
                                        <option value="">Select subdistrict</option>
                                        @foreach (\App\Models\subdistrict::all() as $subdistrict)
                                            <option value="{{ $subdistrict->id }}">{{ $subdistrict->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                        </div>
                    </div>
                </div><!--col-end-->
            </div>

            <div class="row p-3">
                <button type="submit" name="button" class="btn btn-success">Updated</button>
            </div>
            <div class="mb-5"></div>
        </form>
    </div>

@endsection
