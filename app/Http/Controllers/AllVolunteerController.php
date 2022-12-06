<?php

namespace App\Http\Controllers;

use App\User;
use App\Allstate;
use App\Allcity;
use App\Allcountry;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Role;
use App\HasRoles;
use Image;
use Auth;
use App\Wishlist;
use App\Cart;
use App\Order;
use App\ReviewRating;
use App\Question;
use App\Answer;
use App\State;
use App\City;
use App\Country;
use App\Course;
use App\Meeting;
use App\BundleCourse;
use App\BBL;
use App\Instructor;
use App\CourseProgress;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AllVolunteerController extends Controller
{

    // public function __construct()
    // {
    //     return $this->middleware('auth');
    //     $this->middleware('permission:Allvolunteer.view', ['only' => ['viewAllUser']]);
    //     $this->middleware('permission:Allvolunteer.create', ['only' => ['create', 'store']]);
    //     $this->middleware('permission:Allvolunteer.edit', ['only' => ['edit', 'update', 'status']]);
    //     $this->middleware('permission:Allvolunteer.delete', ['only' => ['destroy', 'bulk_delete']]);
    // }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function viewAllUser(Request $request)
    {
        // abort_if(!auth()->user()->can('Allinstructor.view'), 403, 'User does not have the right permissions.');
        $data = User::select('*')->where('role', 'Volunteer')->where('accepted', '=', 1);
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
                ->editColumn('image', 'admin.allvolunteer.image')
                ->editColumn('name', 'admin.allvolunteer.detail')
                ->editColumn('status', 'admin.allvolunteer.status')
                ->editColumn('action', 'admin.allvolunteer.action')
                ->rawColumns(['checkbox', 'image', 'name', 'status', 'action'])
                ->make(true);
        }
        return view('admin.allvolunteer.index');
    }


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
        // abort_if(!auth()->user()->can('Allinstructor.create'), 403, 'User does not have the right permissions.');
        $cities = Allcity::all();
        $states = Allstate::all();
        $countries = Country::all();
        return view('admin.allvolunteer.adduser')->with(['cities' => $cities, 'states' => $states, 'countries' => $countries]);
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
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function volunteerRequest()
    {
        $cities = Allcity::all();
        $states = Allstate::all();
        $countries = Country::all();
        return view('auth.volunteer.guestVolunteer')->with(['cities' => $cities, 'states' => $states, 'countries' => $countries]);
    }
    public function volunteerRequestStore(Request $request)
    {
        
        $data = $this->validate($request, [
            'fname'       => 'required',
            'lname'       => 'required',
            'mobile'      => 'required|regex:/[0-9]{9}/',
            'email'       => 'required|unique:users,email',
            'password'    => 'required|min:6|max:20',
            'study'       => 'required',
            'dob'         => 'required|date',
            'user_img'    => 'mimes:jpg,jpeg,png,bmp,tiff',
            'user_name'    => 'mimes:jpg,jpeg,png,bmp,tiff|unique:users,user_name',
            'type'        => 'required',
            'english_level'          => 'required',
            'latest_obtained_degree' => 'required',
            'Reason_for_joining'      => 'required',
        ]);
        $input = $request->all();
        if ($file = $request->file('user_img')) {
            $optimizeImage = Image::make($file);
            $optimizePath = public_path() . '/images/user_img/';
            $image = time() . $file->getClientOriginalName();
            $optimizeImage->save($optimizePath . $image, 72);
            $input['user_img'] = $image;
        }
        // $input['status'] = isset($request->status) ? 1 : 0;
        $input['status'] = 0;
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


        if ($request->association == 'others') {
            $input['association'] = $request->other_association;
        } else {
            if ($request->association == 'Al_Weam_Society_for_Blind_Females') {
                $input['association'] = 'Al Weam Society for Blind Females';
            } elseif ($request->association == 'Blind_Society') {
                $input['association'] = 'Blind Society';
            }
        }

        $user = User::create($input);
        $input['user_id'] = $user->id;

        if ($file = $request->file('user_img')) {
            $optimizeImage = Image::make($file);
            $optimizePath = public_path() . '/images/instructor/';
            $image = time() . $file->getClientOriginalName();
            $optimizeImage->save($optimizePath . $image, 72);
            $input['image'] = $image;
        }

        $instructor = Instructor::create($input);

        // $user->assignRole($request->role);

        $user->password  = Hash::make($request->password);

        $user->save();
        $instructor->save();

        Session::flash('success', trans('flash.AddedSuccessfully'));
        return redirect()->route('home');
    }
}
