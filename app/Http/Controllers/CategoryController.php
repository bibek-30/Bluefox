<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::where('parent_id', null)->orderby('name', 'asc')->get();
        return $categories;

        // $categories = Category::all();
        // return view('categories.index')->with(compact(['categories']));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {  
            $request-> validate([
            'name'=>'required',
            // 'slug'
            'parent_id'
        ]);

        
        $category = Category::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            // 'slug' => $request->slug
        ]);
        return $category;
    }

    // public function createCategory(Request $request)
    // {
    //     $categories = Category::where('parent_id', null)->orderby('name', 'asc')->get();
    //     if($request->method()=='GET')
    //     {
    //         return view('create-category', compact('categories'));
    //     }
    //     if($request->method()=='POST')
    //     {
    //         $validator = $request->validate([
    //             'name'      => 'required',
    //             'slug'      => 'required|unique:categories',
    //             'parent_id' => 'nullable|numeric'
    //         ]);

    //         Category::create([
    //             'name' => $request->name,
    //             'slug' => $request->slug,
    //             'parent_id' =>$request->parent_id
    //         ]);

    //         return redirect()->back()->with('success', 'Category has been created successfully.');
    //     }
    // }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subcategory(Request $request)
    {
        $categories = Category::whereNotNull('parent_id')->orderby('name', 'asc')->get();
        return $categories;


        // $data = array(
        //     'name' => $request->name,
        //     'category_id' => $request->category_id
        // ) ;
        // dd($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $categories = Category::all();
        // return view('home',['categories'=>$categories]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        return "hello, i am edit.";
        // $category = Category::findOrFail($id);
        // if($request->method()=='GET')
        // {
        //     $categories = Category::where('parent_id', null)->where('id', '!=', $category->id)->orderby('name', 'asc')->get();
        //     return  compact('category', 'categories');
        // }
        // if($request->method()=='POST')
        // {
        //     $validator = $request->validate([
        //         'name'     => 'required',
        //         // 'slug' => ['required', Rule::unique('categories')->ignore($category->id)],
        //         'parent_id'=> 'nullable|numeric'
        //     ]);
        //     if($request->name != $category->name || $request->parent_id != $category->parent_id)
        //     {
        //         if(isset($request->parent_id))
        //         {
        //             $checkDuplicate = Category::where('name', $request->name)->where('parent_id', $request->parent_id)->first();
        //             if($checkDuplicate)
        //             {
        //                 return response('error', 'Category already exist in this parent.');
        //             }
        //         }
        //         else
        //         {
        //             $checkDuplicate = Category::where('name', $request->name)->where('parent_id', null)->first();
        //             if($checkDuplicate)
        //             {
        //                 return response('error', 'Category already exist with this name.');
        //             }
        //         }
        //     }

        //     $category->name = $request->name;
        //     $category->parent_id = $request->parent_id;
        //     $category->slug = $request->slug;
        //     $category->save();
        //     return response('success', 'Category has been updated successfully.');
        // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
            
    }
}
    