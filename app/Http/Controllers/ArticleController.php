<?php

namespace App\Http\Controllers;

use App\Models\article;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        return view('backend.article.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article = new article();
        $article->title=$request->title;
        $article->category_id=$request->category_id;
        $article->body=$request->body;
        $article->thumbnail=$request->thumbnail;
        $article->tags=$request->title;
        if($request->has('video_link')){
            $article->video_provider=$request->video_provider;
            $article->video_link=$request->video_link;
        }

        $article->file=$request->file;
        $article->breaking=$request->breaking;
        $article->featured=$request->featured;
        $article->draft=$request->draft;
        $article->status=$request->status;
        $article->district_id=$request->district_id;
        $article->subdistrict_id=$request->subdistrict_id;
        $article->user_id=1;
        if ($request->slug != null) {
            $article->slug = strtolower($request->slug);
        }
        else {
            $article->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->title)).'-'.Str::random(5);
        }
        $article->save();

        flash('Article has been added successfully')->success();
        return redirect()->route('categories.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(article $article)
    {
        $categories = Category::where('parent_id', 0)
            ->with('childrenCategories')
            ->get();
        return view('backend.article.edit',compact('article','categories'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, article $article)
    {
//            return $request;
        $article->title=$request->title;
        $article->category_id=$request->category_id;
        $article->body=$request->body;
        $article->thumbnail=$request->thumbnail;
        $article->tags=$request->title;
        if($request->has('video_link')){
            $article->video_provider=$request->video_provider;
            $article->video_link=$request->video_link;
        }

        $article->file=$request->file;
        $article->breaking=$request->breaking;
        $article->featured=$request->featured;
        $article->draft=$request->draft;
        $article->status=$request->status;

        $article->district_id=$request->district_id;
        $article->subdistrict_id=$request->subdistrict_id;
        $article->user_id=1;
        if ($request->slug != null) {
            $article->slug = strtolower($request->slug);
        }
        else {
            $article->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->title)).'-'.Str::random(5);
        }
        $article->save();

        flash('Article has been Updated successfully')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(article $article)
    {
        //
    }
}
