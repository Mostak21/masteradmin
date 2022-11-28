<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Country;
use App\Models\State;


class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_city = $request->sort_city;
        $sort_state = $request->sort_state;
        $cities_queries = City::query();
        if($request->sort_city) {
            $cities_queries->where('name', 'like', "%$sort_city%");
        }
        if($request->sort_state) {
            $cities_queries->where('state_id', $request->sort_state);
        }
        $cities = $cities_queries->orderBy('name', 'asc')->paginate(15);
        $states = State::where('status', 1)->get();

        return view('backend.address.cities.index', compact('cities', 'states', 'sort_city', 'sort_state'));
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
        $city = new City;
        $city->name = $request->name;
        $city->state_id = $request->state_id;
        $city->save();

        flash('City has been inserted successfully')->success();

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

        $city  = City::findOrFail($id);
        $states = State::where('status', 1)->get();
        return view('backend.address.cities.edit', compact('city',  'states'));
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
        $city = City::findOrFail($id);
        $city->name = $request->name;
        $city->state_id = $request->state_id;
        $city->save();


        flash('City has been updated successfully')->success();
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
        $city = City::findOrFail($id);

        City::destroy($id);

        flash('City has been deleted successfully')->success();
        return redirect()->route('cities.index');
    }

    public function updateStatus(Request $request){
        $city = City::findOrFail($request->id);
        $city->status = $request->status;
        $city->save();

        return 1;
    }
}
