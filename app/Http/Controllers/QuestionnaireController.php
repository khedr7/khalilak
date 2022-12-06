<?php

namespace App\Http\Controllers;

use App\Questionnaire;
use Validator;
use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $questionnaires = Questionnaire::where('course_id', '=', $request->id)->groupBy('user_id')->get();

        return view('admin.course.questionnaire.index', compact('questionnaires'));
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
     * @param  \App\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ques = Questionnaire::where('id', '=', $id)->first();
        $cor_id = $ques->course_id;
        $user_id = $ques->user_id;
        $questionnaires = Questionnaire::where('course_id', '=', $cor_id)->where('user_id', '=', $user_id)->get();

        return view('admin.course.questionnaire.show', compact('questionnaires'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function edit(Questionnaire $questionnaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Questionnaire $questionnaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Questionnaire  $questionnaire
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ques = Questionnaire::where('id','=', $id)->first();
        $cor_id = $ques->course_id;
        $user_id = $ques->user_id;
        Questionnaire::where('course_id', '=', $cor_id)->where('user_id', '=', $user_id)->delete();

        return back()->with('error', trans('Selected Questionnaire has been deleted.'));
    }

    public function bulk_delete(Request $request)
    {

        $validator = Validator::make($request->all(), ['checked' => 'required']);
        if ($validator->fails()) {
            return back()->with('error', trans('Please select field to be deleted.'));
        }

        $ques = Questionnaire::whereIn('id', $request->checked)->get();
        foreach ($ques as $q) {
            $cor_id = $q->course_id;
            $user_id = $q->user_id;
            Questionnaire::where('course_id', '=', $cor_id)->where('user_id', '=', $user_id)->delete();
        }
        return back()->with('error', trans('Selected Questionnaire has been deleted.'));
    }
}
