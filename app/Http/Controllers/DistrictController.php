<?php

namespace App\Http\Controllers;

use App\Models\city;
use App\Models\district;
use App\Models\state;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index(Request $request)
    {
        $sort_district = $request->sort_district;
        $sort_city = $request->sort_city;
        $districts_queries = District::query();
        if($request->sort_district) {
            $districts_queries->where('name', 'like', "%$sort_district%");
        }
        if($request->sort_city) {
            $districts_queries->where('city_id', $request->sort_city);
        }
        $districts = $districts_queries->orderBy('name', 'asc')->paginate(15);
        $cities = City::where('status', 1)->get();

        return view('backend.address.districts.index', compact('districts', 'cities', 'sort_district', 'sort_city'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $district = new District;
        $district->name = $request->name;
        $district->city_id = $request->city_id;
        $district->save();

        flash('District has been inserted successfully')->success();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {

        $district  = District::findOrFail($id);
        $cities = City::where('status', 1)->get();
        return view('backend.address.districts.edit', compact('district',  'cities'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $district = District::findOrFail($id);
        $district->name = $request->name;
        $district->city_id = $request->city_id;
        $district->save();


        flash('District has been updated successfully')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $district = District::findOrFail($id);

        District::destroy($id);

        flash('District has been deleted successfully')->success();
        return redirect()->route('districts.index');
    }

    public function updateStatus(Request $request){
        $district = District::findOrFail($request->id);
        $district->status = $request->status;
        $district->save();

        return 1;
    }
}
