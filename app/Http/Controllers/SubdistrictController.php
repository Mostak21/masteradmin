<?php

namespace App\Http\Controllers;

use App\Models\district;
use App\Models\subdistrict;
use Illuminate\Http\Request;

class SubdistrictController extends Controller
{
    public function index(Request $request)
    {
        $sort_subdistrict = $request->sort_subdistrict;
        $sort_district = $request->sort_district;
        $subdistricts_queries = Subdistrict::query();
        if($request->sort_subdistrict) {
            $subdistricts_queries->where('name', 'like', "%$sort_subdistrict%");
        }
        if($request->sort_district) {
            $subdistricts_queries->where('district_id', $request->sort_district);
        }
        $subdistricts = $subdistricts_queries->orderBy('name', 'asc')->paginate(15);
        $districts = District::where('status', 1)->get();

        return view('backend.address.subdistricts.index', compact('subdistricts', 'districts', 'sort_district', 'sort_subdistrict'));
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
        $district = new Subdistrict;
        $district->name = $request->name;
        $district->district_id = $request->district_id;
        $district->save();

        flash('Subdistrict has been inserted successfully')->success();

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

        $subdistrict  = Subdistrict::findOrFail($id);
        $districts = District::where('status', 1)->get();
        return view('backend.address.subdistricts.edit', compact('subdistrict',  'districts'));
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
        $district = Subdistrict::findOrFail($id);
        $district->name = $request->name;
        $district->district_id = $request->district_id;
        $district->save();


        flash('Subdistrict has been updated successfully')->success();
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
        $district = Subdistrict::findOrFail($id);

        Subdistrict::destroy($id);

        flash('Subdistrict has been deleted successfully')->success();
        return redirect()->route('subdistricts.index');
    }

    public function updateStatus(Request $request){
        $district = Subdistrict::findOrFail($request->id);
        $district->status = $request->status;
        $district->save();

        return 1;
    }
}
