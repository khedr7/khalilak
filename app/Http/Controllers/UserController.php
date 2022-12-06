<?php

namespace App\Http\Controllers;

use App\Allcity;
use App\Allstate;
use App\Answer;
use App\BBL;
use App\BundleCourse;
use App\Cart;
use App\City;
use App\Country;
use App\Course;
use App\CourseProgress;
use App\FindJob;
use App\Instructor;
use App\Mail\WelcomeUser;
use App\Meeting;
use App\Order;
use App\PlacementTestReport;
use App\Question;
use App\Questionnaire;
use App\Quiz;
use App\QuizAnswer;
use App\ReviewRating;
use App\State;
use App\User;
use App\Wishlist;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Image;
use Session;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
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

    public function viewAllUser(Request $request)
    {
        abort_if(!auth()->user()->can('users.view'), 403, 'User does not have the right permissions.');
        // $data = User::with(['roles'])->select('*');
        $data = User::all()->where('accepted', '=', 1);


        if ($request->ajax()) {

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('checkbox', function ($row) {

                    $chk = "<div class='inline'>
                              <input type='checkbox' form='bulk_delete_form' class='filled-in material-checkbox-input' name='checked[]'' value='$row->id' id='checkbox$row->id'>
                              <label for='checkbox$row->id' class='material-checkbox'></label>
                            </div>";

                    return $chk;
                })
                ->editColumn('image', 'admin.user.image')
                ->editColumn('name', 'admin.user.detail')
                // ->addColumn('role', function ($row) {
                //     $btn = '<a href="javascript:void(0)" class="badge badge-pill badge-primary">' . $row->getRoleNames()->count() ? $row->getRoleNames()->toArray()[0] : '-'. '</a>';
                //     return $btn;
                // })
                ->addColumn('role', function ($row) {

                    return $row->roles[0]->name ?? 'No role set';
                })
                ->editColumn('loginasuser', 'admin.user.login')
                // ->removeColumn('loginasuser')
                ->editColumn('status', 'admin.user.status')
                ->editColumn('action', 'admin.user.action')
                ->rawColumns(['checkbox', 'image', 'name', 'loginasuser', 'role', 'status', 'action'])
                ->make(true);
        }
        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        abort_if(!auth()->user()->can('users.create'), 403, 'User does not have the right permissions.');
        $cities = Allcity::all();
        $states = Allstate::all();
        $countries = Country::all();
        $roles = Role::all();
        return view('admin.user.adduser')->with(['cities' => $cities, 'states' => $states, 'countries' => $countries, 'roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        if (config('app.demolock') == 1) {
            return back()->with('delete', 'Disabled in demo');
        }
        // dd($request);
        abort_if(!auth()->user()->can('users.create'), 403, 'User does not have the right permissions.');
        $data = $this->validate($request, [
            'fname'       => 'required',
            'lname'       => 'required',
            'user_name'   => 'required|unique:users,user_name',
            'mobile'      => 'required|regex:/[0-9]{9}/',
            'email'       => 'required|unique:users,email',
            'password'    => 'required|min:6|max:20',
            'role'        => 'required',
            'study'       => 'required',
            'dob'         => 'required|date',
            'user_img'    => 'mimes:jpg,jpeg,png,bmp,tiff',
            'english_level'          => 'required',
            'latest_obtained_degree' => 'required',
        ]);
        $input = $request->all();
        if ($file = $request->file('user_img')) {
            $optimizeImage = Image::make($file);
            $optimizePath = public_path() . '/images/user_img/';
            $image = time() . $file->getClientOriginalName();
            $optimizeImage->save($optimizePath . $image, 72);
            $input['user_img'] = $image;
        }
        $input['status'] = isset($request->status) ? 1 : 0;
        $input['accepted'] = isset($request->status) ? 1 : 0;
        $input['password'] = Hash::make($request->password);
        $input['detail'] = $request->detail;
        $input['email_verified_at'] = \Carbon\Carbon::now()->toDateTimeString();

        if (isset($request->blind)) {
            $input['blind'] = 1;
        } else {
            $input['blind'] = 0;
        }
        if (isset($request->degree_completed)) {
            $input['degree_completed'] = 1;
        } else {
            $input['degree_completed'] = 0;
        }

        if ($request->type == 'others') {
            $input['type'] = $request->other_type;
        }

        if ($request->role == 'user') {
            $input['role'] = 'user';
        } elseif ($request->role == 'instructor') {
            $input['role'] = 'instructor';
        } elseif ($request->role == 'Volunteer') {
            $input['role'] = 'Volunteer';
        } else {
            $input['role'] = 'admin';
        }

        if ($request->association == 'others') {
            $input['association'] = $request->other_association;
        } else {
            if ($request->association == 'Al_Weam_Society_for_Blind_Females') {
                $input['association'] = 'Al Weam Society for Blind Females';
            } elseif ($request->association == 'Blind_Society') {
                $input['association'] = 'Blind Society';
            }
        }

        $data = User::create($input);

        $data->assignRole($request->role);

        $data->save();
        Mail::to($data->email)->send(new WelcomeUser($data));

        Session::flash('success', trans('flash.AddedSuccessfully'));
        return redirect('user');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */

    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        abort_if(!auth()->user()->can('users.edit'), 403, 'User does not have the right permissions.');
        $cities = City::all();
        $states = State::all();
        $countries = Country::all();
        $roles = Role::all();
        $user = User::findorfail($id);
        if (Auth::User()->role == 'admin') {
            $user = User::findorfail($id);
        } else {
            $user = User::where('id', Auth::User()->id)->first();
        }

        return view('admin.user.edit', compact('cities', 'states', 'countries', 'user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        if (config('app.demolock') == 1) {
            return back()->with('delete', 'Disabled in demo');
        }
        abort_if(!auth()->user()->can('users.edit'), 403, 'User does not have the right permissions.');

        $this->validate($request, [
            'user_img' => 'mimes:jpg,jpeg,png,bmp,tiff',
        ]);

        if (Auth::User()->role == 'admin') {
            $user = User::findorfail($id);
        } else {
            $user = User::where('id', Auth::User()->id)->first();
        }

        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        if (config('app.demolock') == 0) {

            $input = $request->all();

            if ($file = $request->file('user_img')) {

                if ($user->user_img != null) {
                    $content = @file_get_contents(public_path() . '/images/user_img/' . $user->user_img);
                    if ($content) {
                        unlink(public_path() . '/images/user_img/' . $user->user_img);
                    }
                }

                $optimizeImage = Image::make($file);
                $optimizePath = public_path() . '/images/user_img/';
                $image = time() . $file->getClientOriginalName();
                $optimizeImage->save($optimizePath . $image, 72);
                $input['user_img'] = $image;
            }

            $verified = \Carbon\Carbon::now()->toDateTimeString();

            if (isset($request->verified)) {

                $input['email_verified_at'] = $verified;
            } else {

                $input['email_verified_at'] = null;
            }

            if (isset($request->update_pass)) {

                $input['password'] = Hash::make($request->password);
            } else {
                $input['password'] = $user->password;
            }

            if (isset($request->blind)) {
                $input['blind'] = 1;
            } else {
                $input['blind'] = 0;
            }
            if (isset($request->degree_completed)) {
                $input['degree_completed'] = 1;
            } else {
                $input['degree_completed'] = 0;
            }
            if ($request->association == 'others') {
                $input['association'] = $request->other_association;
            } else {
                if ($request->association == 'Al_Weam_Society_for_Blind_Females') {
                    $input['association'] = 'Al Weam Society for Blind Females';
                } elseif ($request->association == 'Blind_Society') {
                    $input['association'] = 'Blind Society';
                }
            }
            if ($request->type == 'others') {
                $input['type'] = $request->other_type;
            }


            if (isset($request->status)) {
                $input['status'] = '1';
            } else {
                $input['status'] = '0';
            }

            if ($request->role == 'user') {

                $input['role'] = 'user';
            } elseif ($request->role == 'instructor') {
                $input['role'] = 'instructor';
            } elseif ($request->role == 'Volunteer' && $request->type == "General English teacher") {
                $input['role'] = 'instructor';
            } elseif ($request->role == 'Volunteer') {
                $input['role'] = 'Volunteer';
            } else {
                $input['role'] = 'admin';
            }

            $user->update($input);

            if ($request->role) {
                $user->syncRoles($request->role);
            }

            Session::flash('success', trans('flash.UpdatedSuccessfully'));
        } else {
            return back()->with('delete', trans('flash.DemoCannotupdate'));
        }

        if (Auth::User()->role == 'admin') {
            return redirect()->route('user.index');
        }
        elseif(Auth::User()->role == 'instructor') {
            return redirect()->route('instructor.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (config('app.demolock') == 1) {
            return back()->with('delete', 'Disabled in demo');
        }
        abort_if(!auth()->user()->can('users.delete'), 403, 'User does not have the right permissions.');
        $user = User::find($id);

        if (config('app.demolock') == 0) {

            if ($user->user_img != null) {

                $image_file = @file_get_contents(public_path() . '/images/user_img/' . $user->user_img);

                if ($image_file) {
                    unlink(public_path() . '/images/user_img/' . $user->user_img);
                }
            }

            $value = $user->delete();
            Course::where('user_id', $id)->delete();
            Wishlist::where('user_id', $id)->delete();
            Cart::where('user_id', $id)->delete();
            Order::where('user_id', $id)->delete();
            ReviewRating::where('user_id', $id)->delete();
            Question::where('user_id', $id)->delete();
            Answer::where('ans_user_id', $id)->delete();
            Meeting::where('user_id', $id)->delete();
            BundleCourse::where('user_id', $id)->delete();
            BBL::where('instructor_id', $id)->delete();
            Instructor::where('user_id', $id)->delete();
            CourseProgress::where('user_id', $id)->delete();
            PlacementTestReport::where('user_id', $id)->delete();
            Quiz::where('user_id', $id)->delete();
            QuizAnswer::where('user_id', $id)->delete();
            FindJob::where('user_id', $id)->delete();
            Questionnaire::where('user_id', $id)->delete();
            Assignment::where('user_id', $id)->delete();

            if ($value) {
                session()->flash('delete', trans('flash.DeletedSuccessfully'));
                return redirect('user');
            }
        } else {
            return back()->with('delete', trans('flash.DemoCannotupdate'));
        }
    }

    public function bulk_delete(Request $request)
    {
        abort_if(!auth()->user()->can('users.delete'), 403, 'User does not have the right permissions.');
        $validator = Validator::make($request->all(), [
            'checked' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('warning', 'Atleast one item is required to be checked');
        } else {
            User::whereIn('id', $request->checked)->delete();

            Session::flash('success', trans('Deleted Successfully'));
            return redirect()->back();
        }
    }

    public function status(Request $request)
    {
        // abort_if(!auth()->user()->can('users.update'), 403, 'User does not have the right permissions.');
        $user = User::find($request->id);
        $user->status = $request->status;
        if ($request->accepted != null) {
            $user->accepted = $request->accepted;
            if ($user->accepted == 1) {
                Mail::to($user->email)->send(new WelcomeUser($user));
            }
        }
        $user->save();
        return response()->json($request->all());
    }
    public function login($id)
    {
        $user = User::findOrFail($id);
        Auth::login($user);
        Session::flash('success', trans('LoginSuccessfully'));
        return redirect('/');
    }
    public function import()
    {
        return view('admin.user.import');
    }

    public function csvfileupload(Request $req)
    {

        $user = User::all();
        $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
        fgetcsv($csvFile);
        $file_data = array();
        $data = array();
        while (($line = fgetcsv($csvFile)) !== FALSE) {
            $data = array(
                'fname' => $line[0],
                'lname' => $line[1],
                'mobile' => $line[2],
                'email' => $line[3],
                'address' => $line[4],
                'gender' => $line[5],
                'user_img' => $line[6],
                'verified' => $line[7],
                'status' => $line[8],
                'role' => $line[9],
                'password' => Hash::make($line[10])

            );
            User::create($data);
        }
        fclose($csvFile);
        Session::flash('success', trans('Import Successfully'));
        return redirect('user');
    }
}
