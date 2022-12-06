<?php

namespace App\Http\Controllers;

use App\PlacementTestReport;
use Illuminate\Http\Request;

class PlacementTestReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\PlacementTestReport  $placementTestReport
     * @return \Illuminate\Http\Response
     */
    public function show(PlacementTestReport $placementTestReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PlacementTestReport  $placementTestReport
     * @return \Illuminate\Http\Response
     */
    public function edit(PlacementTestReport $placementTestReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PlacementTestReport  $placementTestReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $report = PlacementTestReport::findOrFail($id);

        if ($request->speaking_mark != null) {
            $report->speaking_mark = $request->speaking_mark;
        } elseif ($request->final_mark != null) {
            $report->final_mark = $request->final_mark;
        }
        $report->save();

        return redirect()->route('show.placementTestReport', $report->quiz_topic_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PlacementTestReport  $placementTestReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlacementTestReport $placementTestReport)
    {
        //
    }
}
