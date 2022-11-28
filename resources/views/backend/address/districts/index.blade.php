@extends('backend.layouts.app')

@section('content')
    <div class="rit-titlebar text-left mt-2 mb-3">
    	<div class="row align-items-center">
    		<div class="col-md-12">
    			<h1 class="h3">All districts</h1>
    		</div>
    	</div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <form class="" id="sort_districts" action="" method="GET">
                    <div class="card-header row gutters-5">
                        <div class="col text-center text-md-left">
                            <h5 class="mb-md-0 h6">Cities</h5>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="sort_district" name="sort_district" @isset($sort_district) value="{{ $sort_district }}" @endisset placeholder="Type district name & Enter">
                        </div>
                        <div class="col-md-4">
                            <select class="form-control rit-selectpicker" data-live-search="true" id="sort_city" name="sort_city">
                                <option value="">Select City</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" @if ($sort_city == $city->id) selected @endif {{$sort_city}}>
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-primary" type="submit">Filter</button>
                        </div>
                    </div>
                </form>
                <div class="card-body">
                    <table class="table rit-table mb-0">
                        <thead>
                            <tr>
                                <th data-breakpoints="lg">#</th>
                                <th>Name</th>
                                <th>City</th>
                                <th>Show/Hide</th>
                                <th data-breakpoints="lg" class="text-right">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($districts as $key => $district)
                                <tr>
                                    <td>{{ ($key+1) + ($districts->currentPage() - 1)*$districts->perPage() }}</td>
                                    <td>{{ $district->name }}</td>
                                    <td>{{ $district->city->name }}</td>
                                    <td>
                                        <label class="rit-switch rit-switch-success mb-0">
                                          <input onchange="update_status(this)" value="{{ $district->id }}" type="checkbox" <?php if($district->status == 1) echo "checked";?> >
                                          <span class="slider round"></span>
                                        </label>
                                      </td>
                                    <td class="text-right">
                                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('districts.edit', ['id'=>$district->id, 'lang'=>env('DEFAULT_LANGUAGE')]) }}" title="Edit">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('districts.destroy', $district->id)}}" title="Delete">
                                            <i class="las la-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="rit-pagination">
                        {{ $districts->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
    		<div class="card">
    			<div class="card-header">
    				<h5 class="mb-0 h6">Add New district</h5>
    			</div>
    			<div class="card-body">
    				<form action="{{ route('districts.store') }}" method="POST">
    					@csrf
    					<div class="form-group mb-3">
    						<label for="name">Name</label>
    						<input type="text" placeholder="Name" name="name" class="form-control" required>
    					</div>

                        <div class="form-group">
                            <label for="country">City</label>
                            <select class="select2 form-control rit-selectpicker" name="city_id" data-toggle="select2" data-placeholder="Choose ..." data-live-search="true">
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
    					<div class="form-group mb-3 text-right">
    						<button type="submit" class="btn btn-primary">Save</button>
    					</div>
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')
    <script type="text/javascript">
        function sort_districts(el){
            $('#sort_districts').submit();
        }

        function update_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('districts.status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    RIT.plugins.notify('success', 'District status updated successfully');
                }
                else{
                    RIT.plugins.notify('danger', 'Something went wrong');
                }
            });
        }

    </script>
@endsection
