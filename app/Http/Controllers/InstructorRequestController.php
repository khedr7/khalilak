<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instructor;
use App\Mail\JoinusMail;
use App\Mail\WelcomeUser;
use DB;
use App\User;
use Validator;
use Hash;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\Else_;
use Spatie\Permission\Models\Role;


class InstructorRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:instructorrequest.view', ['only' => ['index']]);
        $this->middleware('permission:instructorrequest.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:instructorrequest.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:instructorrequest.delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $items = Instructor::where('status', '0')->get();
        $items = $items->where('type', 'like', "General English teacher");
        return view('admin.instructor.instructor_request.index', compact('items'));
    }
    public function volunteerIndex()
    {
        $items = Instructor::where('status', '0')->get();
        $items = $items->where('type', '!=', "General English teacher");

        return view('admin.instructor.volunteer_request.index', compact('items'));
    }

    public function create()
    {
        $data = Instructor::all();
        return view('admin.instructor.instructor_request.create', compact('data'));
    }

    public function edit($id)
    {
        $instructor = Instructor::where('id', $id)->first();
        $show = User::where('id', $instructor->user_id)->first();
        return view('admin.instructor.instructor_request.view', compact('show', 'instructor'));
    }

    public function update(Request $request, $id)
    {

        // $input['status'] = $request->status;

        //  --- old code ---

        // if ($instructor->status == 1) {
        //     $show = User::where('id', $request->user_id)->first();
        //     $input['role'] = 'user';

        //     User::where('id', $request->user_id)
        //         ->update(['role' => 'user']);
        //     Instructor::where('user_id', $request->user_id)
        //         ->update(['status' => 0]);
        // } else {

        //     $show = User::where('id', $request->user_id)->first();
        //     $abc['role'] = $request->role;

        //     User::where('id', $request->user_id)
        //         ->update(['role' => $request->role]);
        //     Instructor::where('user_id', $request->user_id)
        //         ->update(['status' => 1]);
        // }

        //  --- new code ---
        $instructor = Instructor::findorfail($id);
        $user = User::where('id', $request->user_id)->first();

        $input = $request->all();
        if (isset($request->status)) {
            $input['status'] = 1;
            if ($input['status'] == 1 && $instructor->status == 0) {
                User::where('id', $request->user_id)
                    ->update(['role' => $request->role]);

                Instructor::where('user_id', $request->user_id)
                    ->update(['role' => $request->role]);

                Instructor::where('user_id', $request->user_id)
                    ->update(['status' => 1]);

                $user->status = 1;
                $user->accepted = 1;
                $user->save();
                $instructor->save();

                // Mail::to($user->email)->send(new JoinusMail($user, $password));
                Mail::to($user->email)->send(new WelcomeUser($user));
            }
        }

        // $input['detail'] = $request->detail;
        // $input['mobile'] = $request->mobile;

        // User::where('id', $request->user_id)
        //     ->update(['detail' => $request->detail, 'mobile' => $request->mobile]);

        if ($user->type == 'General English teacher') {
            return redirect()->route('requestinstructor.index');
        } else {
            return redirect()->route('all.volunteer');
        }
    }

    public function destroy($id)
    {
        DB::table('instructors')->where('id', $id)->delete();
        return back();
    }

    public function allinstructor()
    {
        $items = Instructor::where('type', 'like', "General English teacher")->get();
        return view('admin.instructor.all_instructor.index', compact('items'));
    }
    public function allvolunteer()
    {
        // $items = Instructor::all();
        $items = Instructor::where('type', '!=', "General English teacher")->get();
        return view('admin.instructor.all_volunteer.index', compact('items'));
    }

    public function instructorpage()
    {

        return view('front.instructor');
    }


    public function instructor(Request $request)
    {
        $users = Instructor::where('user_id', $request->user_id)->get();

        if (!$users->isEmpty()) {
            return back()->with('delete', trans('flash.AlreadyRequested'));
        } else {


            $request->validate([
                'file' => 'mimes:jpeg,png,jpg,bmp,webp,zip,pdf',
                'image' => 'mimes:jpg,jpeg,png,bmp,webp'
            ]);

            $input = $request->all();


            if ($file = $request->file('image')) {


                $validator = Validator::make(
                    [
                        'file' => $request->image,
                        'extension' => strtolower($request->image->getClientOriginalExtension()),
                    ],
                    [
                        'file' => 'required',
                        'extension' => 'required|in:jpg,jpeg,bmp,png,webp',
                    ]
                );

                if ($validator->fails()) {
                    return back()->withErrors('Invalid file !');
                }

                if ($file = $request->file('image')) {
                    $name = time() . $file->getClientOriginalName();
                    $file->move('images/instructor', $name);
                    $input['image'] = $name;
                }
            }


            if ($file = $request->file('file')) {


                $validator = Validator::make(
                    [
                        'file' => $request->file,
                        'extension' => strtolower($request->file->getClientOriginalExtension()),
                    ],
                    [
                        'file' => 'required',
                        'extension' => 'required|in:jpeg,png,jpg,bmp,webp,zip,pdf',
                    ]
                );

                if ($validator->fails()) {
                    return back()->withErrors('Invalid file !');
                }

                if ($file = $request->file('file')) {
                    $name = time() . $file->getClientOriginalName();
                    $file->move('files/instructor/', $name);
                    $input['file'] = $name;
                }
            }
            $data = Instructor::create($input);
            $data->save();
        }

        return back()->with('success', trans('flash.RequestSuccessfully'));
    }
}
