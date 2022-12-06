<?php

namespace App\Http\Controllers;

use App\ChapterLevel;
use App\CourseChapter;
use Illuminate\Http\Request;
use DB;
use Auth;
use Session;

use Illuminate\Support\Facades\Validator;


class ChapterLevelController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // abort_if(!auth()->user()->can('subcategories.view'),403,'User does not have the right permissions.');
        $levels = ChapterLevel::all();
        $chapters = CourseChapter::orderby('id', 'ASC')->where('course_id', "=", null)->get();
        return view('admin.chapterLevel.index', compact('levels', 'chapters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // abort_if(!auth()->user()->can('subcategories.create'),403,'User does not have the right permissions.');
        $data = $this->validate($request, [
            "title" => "required",
        ], [
            "title.required" => "Please enter level title !",
            "slug" => "required",
            "icon" => "required",
            "chapter_id" => "required"
        ]);

        $input = $request->all();
        $slug = str_slug($input['title'], '-');
        $input['slug'] = $slug;
        $input['status'] = isset($request->status)  ? 1 : 0;
        $data = ChapterLevel::create($input);

        $data->save();

        Session::flash('success', trans('flash.AddedSuccessfully'));
        return redirect('level');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ChapterLevel  $chapterLevel
     * @return \Illuminate\Http\Response
     */
    public function show(ChapterLevel $chapterLevel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ChapterLevel  $chapterLevel
     * @return \Illuminate\Http\Response
     */
    public function edit(ChapterLevel $chapterLevel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ChapterLevel  $chapterLevel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // abort_if(!auth()->user()->can('subcategories.edit'), 403, 'User does not have the right permissions.');
        $data = $this->validate($request, [
            "title" => "required",
            "title.required" => "Please enter level title !",
            // "title.unique" => "This level name is already exist !",
            "slug" => "required",
            "icon" => "required",
            "chapter_id" => "required"
        ]);

        $data = ChapterLevel::findorfail($id);
        $input = $request->all();

        // $slug = str_slug($input['title'],'-');
        // $input['slug'] = $slug;

        if (isset($request->status)) {
            $input['status'] = '1';
        } else {
            $input['status'] = '0';
        }


        $data->update($input);
        Session::flash('success', trans('flash.UpdatedSuccessfully'));
        return redirect('level');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ChapterLevel  $chapterLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // abort_if(!auth()->user()->can('subcategories.delete'),403,'User does not have the right permissions.');
        if (Auth::User()->role == "admin") {


            // $course = Course::where('subcategory_id', $id)->get();
            DB::table('chapter_levels')->where('id', $id)->delete();

            return back()->with('delete', trans('flash.DeletedSuccessfully'));
        }

        return redirect('level');
    }

    public function status(Request $request)
    {
        abort_if(!auth()->user()->can('subcategories.update'), 403, 'User does not have the right permissions.');

        $level = ChapterLevel::find($request->id);
        $level->status = $request->status;
        $level->save();
        return back()->with('success', trans('flash.UpdatedSuccessfully'));
    }

    public function bulk_delete(Request $request)
    {
        abort_if(!auth()->user()->can('subcategories.delete'), 403, 'User does not have the right permissions.');
        $validator = Validator::make($request->all(), ['checked' => 'required']);

        if ($validator->fails()) {
            return back()->with('error', trans('Please select field to be deleted.'));
        }
        ChapterLevel::whereIn('id', $request->checked)->delete();

        return back()->with('error', trans('Selected SubCategory has been deleted.'));
    }
}
