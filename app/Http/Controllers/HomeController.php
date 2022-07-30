<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Group;
use App\Models\Users;
use Auth;
use Datatables;
use DB;
use Illuminate\Support\Facades\Input;

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
//    public function index()
//    {
//        $data['users'] = User::count();
//        $data['groups'] = 5;
//        $data['films'] = 2;
//        return view('home.index')->with('data', $data);
//        // return view('dashboard',compact('ymen','ywomen','men','women','noofmembers'));
//    }
    public function index()
    {

        return view('home.home');
    }

    public function redirect()
    {
        if ((Auth::User()->GroupID === 1 || Auth::User()->GroupID === 2)) {
            return redirect('dashboard');
        } elseif ((Auth::User()->GroupID === 3)) {
            return redirect('rater');
        } elseif ((Auth::User()->GroupID === 4)) {
            return redirect('moderator');
        } elseif ((Auth::User()->GroupID === 5)) {
            return redirect('client');
        }
    }

    public function reportsDasboard()
    {
        $data['users'] = Users::count();
        $data['groups'] = Group::count();
        $data['films'] = Film::count();
        return view('home.index')->with('data', $data);
    }
}
