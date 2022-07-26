<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::all();

        return response()->json($banners, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'info*.title' => 'required|unique:banners|min:3|max:255',
            // 'cover' => 'required|required|mimes:jpg,jpeg,png|max:5048|unique:banners',
            'cover_img' => 'required|mimes:jpg,jpeg,png|max:5048',
            'info*.status' => 'required|in:active,inactive'
        ]);

        $banner_data= json_decode($request->data);
        $file_banner = $request->file('cover_img');
        $filename_banner = uniqid() . '.' . $file_banner->extension();
        $file_banner->storeAs('public/images/banner', $filename_banner);

        Banner::create([
            'title' => $banner_data->title,
            'cover_img' => $filename_banner,
            'status' => $banner_data->status
        ]);

        $response = [
            "status" => true,
            "message" => "Banner Added Successfully",
        ];
        // Response if banner added successfully 
        return response()->json($response, 201);
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $banner = Banner::find($id);

        if (!$banner) {
            return response()->json(["message" => "Banner not found"], 404);
        }

        return response()->json($banner, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'min:3|max:255'
        ]);

        $banner = Banner::find($id);
        $banner->title = $request->title ? $request->title : $banner->title;
        $banner->cover = $request->cover ? $request->cover : $banner->cover;
        $banner->status = $request->status ? $request->status : $banner->status;
        $banner->update();


        $errResponse = [
            "status" => false,
            "message" => "Update error"
        ];

        if (!$banner) {
            return response()->json($errResponse, 404);
        }

        $successResponse = [
            "status" => true,
            "message" => "Successfully Updated"
        ];

        return response()->json($successResponse, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);
        if (!$banner) {
            return response()->json(["message" => "Banner not found"], 404);
        }
        $banner->delete();
        $successResponse = ["message" => "Banner deleted successfully"];
        return response()->json($successResponse, 200);
    }
}
