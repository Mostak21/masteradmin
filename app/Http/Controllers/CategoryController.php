<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\uploadedfile;
use App\Utility\CategoryUtility;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $categories = Category::orderBy('order', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $categories = $categories->where('name', 'like', '%'.$sort_search.'%');
        }
        $categories = $categories->paginate(15);
        return view('backend.categories.index', compact('categories', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id', 0)
            ->with('childrenCategories')
            ->get();
        return view('backend.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new category();
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->level = 1;
        if ($request->parent_id != "0")
        {
            $category->parent_id = $request->parent_id;
            $parent = Category::find($request->parent_id);
            $category->level = $parent->level + 1 ;
        }
        $category->order = $request->order;
        $category->banner=$request->banner;
        $category->icon=$request->icon;
        $category->bg_menu=$request->bgmenu;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;

        if ($request->slug != null)
        {
            $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        }
        else
        {
            $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name));
        }
        $category->save();

        flash('Category has been inserted successfully')->success();
        return redirect()->route('categories.create');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category= category::find($id);
//        dd($category);
        $categories=category::all();
        return view('backend.categories.edit',compact('category','categories'));
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
        $category = Category::find($id);
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;

        $previous_level = $category->level;
        if ($request->parent_id != "0") {
            $category->parent_id = $request->parent_id;

            $parent = Category::find($request->parent_id);
            $category->level = $parent->level + 1 ;
        }
        else{
            $category->parent_id = 0;
            $category->level = 0;
        }



        if($category->level > $previous_level){
            CategoryUtility::move_level_down($category->id);
        }
        elseif ($category->level < $previous_level) {
            CategoryUtility::move_level_up($category->id);
        }

        $category->order = $request->order;
        $category->banner=$request->banner;
        $category->icon=$request->icon;
        $category->bg_menu=$request->bgmenu;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;

        if ($request->slug != null)
        {
            $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
        }
        else
        {
            $category->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->name));
        }
        $category->save();

        flash('Category has been updated successfully')->success();
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
//        foreach (Product::where('category_id', $category->id)->get() as $product) {
//            $product->category_id = null;
//            $product->save();
//        }

        CategoryUtility::delete_category($id);

        flash( 'Category has been deleted successfully' )->success();
        return redirect()->route('categories.index');
    }
}
