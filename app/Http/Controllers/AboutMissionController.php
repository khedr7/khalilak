<?php

namespace App\Http\Controllers;

use App\AboutMission;
use Illuminate\Http\Request;
use Session;


class AboutMissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about = AboutMission::all();
        return view('admin.aboutMission.index', compact('about'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.aboutMission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            "title"          => "required|unique:categories,title",
            "title.required" => "Please enter category title !",
            "title.unique"   => "This Category name is already exist !",
            "description"    => "required",
            "type"           => "required"
        ]);

        // $input = $request->all();
        $about = AboutMission::create($data);
        Session::flash('success', trans('flash.AddedSuccessfully'));
        return redirect('about-khalilak');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AboutMission  $aboutMission
     * @return \Illuminate\Http\Response
     */
    public function show(AboutMission $aboutMission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AboutMission  $aboutMission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $about = AboutMission::find($id);
        return view('admin.aboutMission.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AboutMission  $aboutMission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "title"          => "required|unique:categories,title",
            "title.required" => "Please enter category title !",
            "title.unique"   => "This Category name is already exist !",
            "description"    => "required",
            "type"           => "required"
        ]);
        $about = AboutMission::find($id);

        $about->title = $request->title;
        $about->description = $request->description;
        $about->type = $request->type;
        $about->save();

        // $input = $request->all();
        Session::flash('success', trans('flash.AddedSuccessfully'));
        return redirect('about-khalilak');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AboutMission  $aboutMission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $about = AboutMission::find($id);
        $value = $about->delete();

        if ($value) {
            session()->flash('delete', trans('flash.DeletedSuccessfully'));
            return redirect('about-khalilak');
        }
    }
}
