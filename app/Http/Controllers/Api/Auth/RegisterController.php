<?php

namespace App\Http\Controllers\Api\Auth;

use App\HelperClasses\ImageManager;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Client;
use App\Setting;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\Mail\verifyEmail;
use App\Mail\WelcomeUser;
use Illuminate\Support\Facades\Mail;
use Image;
use Hash;
use Validator;


use App\Http\Controllers\Api\VerificationController;
use App\Instructor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    use IssueTokenTrait;

    private $client;

    public function __construct()
    {
        $this->client = Client::find(2);
    }

    public function register(Request $request)
    {

        $this->validate($request, [
            'fname'       => 'required',
            'lname'       => 'required',
            'user_name'   => 'required|unique:users,user_name',
            'mobile'      => 'required|regex:/[0-9]{9}/',
            'email'       => 'required|unique:users,email',
            'password'    => 'required|min:6|max:20',
            'study'       => 'required',
            'dob'         => 'required|date',
            'user_img'    => 'mimes:jpg,jpeg,png,bmp,tiff',
            'english_level'          => 'required',
            'latest_obtained_degree' => 'required',
        ]);

        $config = Setting::first();

        if ($config->mobile_enable == 1) {

            $request->validate([
                'mobile' => 'required|numeric'
            ]);
        }

        if ($config->verify_enable == 0) {
            $verified = \Carbon\Carbon::now()->toDateTimeString();
        } else {
            $verified = NULL;
        }

        $input = $request->all();
        $imgformat = $request->file('user_img')->extension();

        // if ($file = $request->file('user_img')) {
        //     $optimizeImage = Image::make($file);
        //     $optimizePath = public_path() . '/images/user_img/';
        //     $image = time() . $file->getClientOriginalName();
        //     $optimizeImage->save($optimizePath . $image, 72);
        //     $input['user_img'] = $image;
        // }

        if ($img = $request->file('user_img')) {
            $input['user_img'] = ImageManager::upload('images/user_img/', $imgformat, $img, $request->user_name);
        }

        $input['status'] = 0;
        $input['accepted'] = 0;
        $input['password'] = Hash::make($request->password);
        // $input['password'] = bcrypt(request('password'));

        $input['email_verified_at'] = \Carbon\Carbon::now()->toDateTimeString();
        $input['role'] = 'user';

        if ($request->association == "others") {
            $input['association'] = $request->other_association;
        }
        // else {
        //     if ($request->association == 'Al_Weam_Society_for_Blind_Females') {
        //         $input['association'] = 'Al Weam Society for Blind Females';
        //     } elseif ($request->association == 'Blind_Society') {
        //         $input['association'] = 'Blind Society';
        //     }
        // }

        $user = User::create($input);

        $user->assignRole($input['role']);

        $user->save();


        // if ($config->w_email_enable == 1) {
        //     try {
        //         Mail::to(request('email'))->send(new WelcomeUser($user));
        //     } catch (\Exception $e) {
        //         return response()->json('Registration done. Mail cannot be sent', 201);
        //     }
        // }

        if ($config->verify_enable == 0) {
            return $this->issueToken($request, 'password');
        } else {
            if ($verified != NULL) {
                return $this->issueToken($request, 'password');
            } else {
                $user->sendEmailVerificationNotificationViaAPI();
                Mail::to(request('email'))->send(new WelcomeUser($user));
                return response()->json('Verify your email', 402);
            }
        }
    }

    public function joinUsVolunteer(Request $request)
    {

        $this->validate($request, [
            'fname'       => 'required',
            'lname'       => 'required',
            'user_name'   => 'required|unique:users,user_name',
            'mobile'      => 'required|regex:/[0-9]{9}/',
            'email'       => 'required|unique:users,email',
            'password'    => 'required|min:6|max:20',
            'study'       => 'required',
            'dob'         => 'required|date',
            'user_img'    => 'mimes:jpg,jpeg,png,bmp,tiff',
            'type'        => 'required',
            'latest_obtained_degree' => 'required',
            'english_level'          => 'required',
            'Reason_for_joining'     => 'required',

        ]);

        $input = $request->all();
        $cvformat = $request->file('file')->extension();
        $imgformat = $request->file('user_img')->extension();


        if ($request->type == 'General English teacher') {
            $request->validate([
                'file' => 'mimes:jpeg,png,jpg,bmp,webp,zip,pdf',
            ]);

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
                    $input['file'] = ImageManager::upload('files/instructor/', $cvformat, $file, $request->user_name);
                }
            }
        }

        $config = Setting::first();

        if ($config->verify_enable == 0) {
            $verified = \Carbon\Carbon::now()->toDateTimeString();
        } else {
            $verified = NULL;
        }


        if ($img = $request->file('user_img')) {
            $input['user_img'] = ImageManager::upload('images/user_img/', $imgformat, $img, $request->user_name);
        }


        $input['status'] = 0;
        $input['accepted'] = 0;
        $input['password'] = Hash::make($request->password);
        // $input['password'] = bcrypt(request('password'));

        $input['email_verified_at'] = \Carbon\Carbon::now()->toDateTimeString();

        if (isset($request->blind)) {
            $input['blind'] = $request->blind;
        } else {
            $input['blind'] = 0;
        }

        if (isset($request->degree_completed)) {
            $input['degree_completed'] = $request->degree_completed;
        } else {
            $input['degree_completed'] = 0;
        }


        if ($request->association == 'others') {
            $input['association'] = $request->other_association;
        }

        if ($request->type == 'others') {
            $input['type'] = $request->other_type;
        }

        $user = User::create($input);



        $input['user_id'] = $user->id;

        if ($imgfile = $request->file('user_img')) {
            $input['image'] = ImageManager::upload('images/instructor/', $imgformat, $imgfile, $request->user_name);
        }


        if ($user->type == 'General English teacher') {
            $user->assignRole('instructor');
            $input['role'] = 'instructor';
        } else {
            $user->assignRole('Volunteer');
            $input['role'] = 'Volunteer';
        }
        $instructor = Instructor::create($input);


        // $user->role = $input['role'];
        $user->save();
        $instructor->save();


        // if ($config->w_email_enable == 1) {
        //     try {
        //         Mail::to(request('email'))->send(new WelcomeUser($user));
        //     } catch (\Exception $e) {
        //         return response()->json('Registration done. Mail cannot be sent', 201);
        //     }
        // }

        if ($config->verify_enable == 0) {
            return $this->issueToken($request, 'password');
        } else {
            if ($verified != NULL) {
                return $this->issueToken($request, 'password');
            } else {
                $user->sendEmailVerificationNotificationViaAPI();
                Mail::to(request('email'))->send(new WelcomeUser($user));
                return response()->json('Verify your email', 402);
            }
        }
    }



    public function userToVolunteer(Request $request)
    {

        $this->validate($request, [
            'type' => 'required',
            'Reason_for_joining' => 'required',
        ]);

        $input = $request->all();


        if ($request->type == 'General English teacher') {
            $request->validate([
                'file' => 'mimes:jpeg,png,jpg,bmp,webp,zip,pdf',
            ]);

            if ($file = $request->file('file')) {

                $cvformat = $request->file('file')->extension();

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
                    $input['file'] = ImageManager::upload('files/instructor/', $cvformat, $file, $request->user_name);
                }
            }
        }


        if ($request->type == 'others') {
            $input['type'] = $request->other_type;
        }

        $user = Auth::user();

        // $user = User::where('id', $user_id)->first();
        // $imgformat = $request->file('user_img')->extension();


        if ($imgfile = $user->user_img) {
            File::copy('images/user_img/' . $user->user_img, 'images/instructor/' . $user->user_img);
            $input['image'] = $user->user_img;
        }


        if ($request->type == 'General English teacher') {
            $input['role'] = 'instructor';
        } else {
            $input['role'] = 'Volunteer';
        }
        $instructor = Instructor::create($input);
        $instructor->user_id = $user->id;
        $instructor->dob = $user->dob;
        $instructor->fname = $user->fname;
        $instructor->lname = $user->lname;
        $instructor->email = $user->email;
        $instructor->mobile = $user->mobile;
        $instructor->detail = $user->detail;
        $instructor->role = $input['role'];
        $instructor->status = 0;

        if ($request->disabled) {
            $user->disabled = $input['disabled'];
        }
        if ($request->interview_date) {
            $user->interview_date = $input['interview_date'];
        }
        if ($request->file('file')) {
            $user->file = $input['file'];
        }
        $user->type = $input['type'];
        $user->Reason_for_joining = $input['Reason_for_joining'];

        $instructor->save();
        $user->save();

        return response()->json(array('message' => 'You have successfully send your request', 'status' => 'success'), 200);
    }



    public function verifyemail(Request $request)
    {


        $user = User::where(['email' => $request->email, 'verifyToken' => $request->token])->first();
        if ($user) {
            $user->status = 1;
            $user->verifyToken = NULL;
            $user->save();
            Mail::to($user->email)->send(new WelcomeUser($user));
            return $this->issueToken($request, 'password');
        } else {

            return response()->json('User not found', 401);
        }
    }
}
