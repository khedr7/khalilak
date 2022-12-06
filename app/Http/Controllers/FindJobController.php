<?php

namespace App\Http\Controllers;

use App\FindJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FindJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = FindJob::all();
        return view('admin.findJob.index', compact('items'));
    }

    public function pending()
    {
        $items = FindJob::where('status', '0')->get();
        return view('admin.findJob.pending', compact('items'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FindJob  $findJob
     * @return \Illuminate\Http\Response
     */
    public function show(FindJob $findJob)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FindJob  $findJob
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $findJob = FindJob::where('id', $id)->first();
        $show = $findJob->user;
        return view('admin.findJob.view', compact('show', 'findJob'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FindJob  $findJob
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $findJob = FindJob::findorfail($id);
        $input = $request->all();
        if (isset($request->status)) {
            $input['status'] = 1;
        }
        $findJob->status = 1;
        $findJob->save();
        return redirect()->route('requestjob.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FindJob  $findJob
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('find_jobs')->where('id', $id)->delete();
        return back();
    }
}
