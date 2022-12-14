<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Course;
use Auth;
use App\RefundCourse;
use Spatie\Permission\Models\Role;

class InstructorEnrollController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:orders.manage', ['only' => ['index']]);
    }
    public function index()
    {
        $refunds = RefundCourse::get();
        $orders = Order::where('instructor_id', Auth::User()->id)->get();
        $pendings = Order::where('status', '=', 0)->where('instructor_id', Auth::User()->id)->whereHas('courses')->orWhereHas('bundle')->orderBy('id', 'DESC')->get();

        // return view('admin.order.show', compact('orders', 'refunds'));

        return view('admin.order.show', compact('orders', 'refunds', 'pendings'));      
    }
}
