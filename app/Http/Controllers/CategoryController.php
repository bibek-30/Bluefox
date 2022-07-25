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
            'name'=>'required|unique',
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editCategory($id, Request $request)

    {
        $request->validate([
            'name',
        ]);
        $category = Category::find($id);
        $category->name = $request->name ? $request->name : $category->name;
        // $category->parent_id = $request->parent_id ? $request -> parent_id : $category->parent_id;
        $category->update(); 

        $errResponse = [
            "status" => false,
            "message" => "Update error"
        ];

        if (!$category) {
            return response()->json($errResponse, 404);
        }

        $successResponse = [
            "status" => true,
            "message" => "Successfully Updated"
        ];

        return response()->json($successResponse, 201);

        // return $category;


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
        DB::table('Categories')->whereNull('parent_id')->get();
        }
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
    