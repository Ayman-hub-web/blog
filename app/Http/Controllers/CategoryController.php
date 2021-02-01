<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('backEnd.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backEnd.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        //image upload
        if($request->hasFile('cat_image')){
            $image=$request->file('cat_image');
            $reImage=time().'.'.$image->getClientOriginalExtension();
            $dest=public_path('/imgs');
            $image->move($dest,$reImage);
        }else{
            $reImage='na';
            return redirect()->back()->with('error', 'No File found!');
        }
        //store Category
        $category = new Category();
        $category->title = $request->title;
        $category->detail = $request->detail;
        $category->image = $reImage;
        $category->save();
        return redirect()->route('category.index')->with('success', 'Category added successflly!');
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
        $category = Category::where('id', $id)->first();
        return view('backEnd.categories.edit', compact('category'));
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
        $request->validate([
            'title' => 'required',
        ]);

        //image upload
        if($request->hasFile('cat_image')){
            $image=$request->file('cat_image');
            $reImage=time().'.'.$image->getClientOriginalExtension();
            $dest=public_path('/imgs');
            $image->move($dest,$reImage);
        }else{
            $reImage=$request->cat_image;
        }
        //store Category
        $category = Category::find($id);
        $category->title = $request->title;
        $category->detail = $request->detail;
        $category->image = $reImage;
        $category->save();
        return redirect()->route('category.index')->with('success', 'Category updated successflly!');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if($category){
            $category->delete();
            return redirect()->route('category.index')->with('success', 'Category successfully deleted!');
        }else{
            return redirect()->route('category.index')->with('error', 'Category can not be deleted!');
        }
    }
}
