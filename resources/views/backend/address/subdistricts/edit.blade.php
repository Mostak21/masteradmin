@extends('backend.layouts.app')

@section('content')

<div class="rit-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">Sub District/Upazilla Information</h5>
</div>

<div class="row">
  <div class="col-lg-8 mx-auto">
      <div class="card">
          <div class="card-body p-0">
              <ul class="nav nav-tabs nav-fill border-light">

    			</ul>
              <form class="p-4" action="{{ route('subdistricts.update', $subdistrict->id) }}" method="POST" enctype="multipart/form-data">
                  <input name="_method" type="hidden" value="PATCH">

                  @csrf
                  <div class="form-group mb-3">
                      <label for="name">Name</label>
                      <input type="text" placeholder="Name" value="{{ $subdistrict->name }}" name="name" class="form-control" required>
                  </div>

                  <div class="form-group">
                      <label for="district_id">State</label>
                      <select class="select2 form-control rit-selectpicker" name="district_id" data-selected="{{ $subdistrict->district_id }}" data-toggle="select2" data-placeholder="Choose ..." data-live-search="true">
                          @foreach ($districts as $district)
                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="form-group mb-3 text-right">
                      <button type="submit" class="btn btn-primary">Update</button>
                  </div>
              </form>
              <p class="m-2 fw-100 fs-12"> *Put only one space in duration input for delete the instance</p>
          </div>
      </div>
  </div>
</div>

@endsection

@section('script')

@endsection
