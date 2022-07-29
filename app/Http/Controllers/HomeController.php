<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Group;
use App\Models\User;
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
    public function index()
    {
        $data['users'] = User::count();
        $data['groups'] = 5;
        $data['films'] = 2;
        return view('home.index')->with('data', $data);
        // return view('dashboard',compact('ymen','ywomen','men','women','noofmembers'));
    }
}
