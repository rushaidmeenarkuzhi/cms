<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
  
        $user = Auth::user();
        if ($user->user_type != 1) {
        if ($user->user_type == 2) {
            return redirect('/complaints')->with('error', 'Access Denied: Only Admin can view Dashboard.');
        } elseif ($user->user_type == 3) {
            return redirect('/technician_list')->with('error', 'Access Denied: Only Admin can view Dashboard.');
        }

        return redirect('/login');
    }
    
        $customer = User::where('user_type',  2)->join('complaints', 'users.id', '=', 'complaints.user_id')
        ->select('users.id', 'users.name', 'users.email', 'complaints.ticket_id','complaints.status')
        ->get();
        return view('home',compact('customer'));
    }

   
}
