<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\AuditLog;
use App\Models\Users;
use Auth;
use Datatables;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mail;
use Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(array('auth'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = DB::table('groups')->pluck('groupname', 'id');
        return view('users.index', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required|unique:users',
            'GroupID' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|max:255|unique:users',
        ]);
        $validator = Validator::make($request->all(), [
            'phone' => 'required|unique:users',
            'GroupID' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|max:255|unique:users',
        ]);
        if ($validator->fails()) {
            //Record Audit Logs
            $logs = new AuditLog();
            $logs->username = Auth::User()->username;
            $logs->activity = "Create User: Validation error ";
            $logs->status = "0";
            $logs->userID = Auth::User()->id;
            $logs->save();
            return response()->json([
                'success' => false,
                'status' => '01',
                'errors' => $validator->errors()->toArray()
            ]);
        } else {
            $rand = substr(md5(microtime()), rand(0, 26), 5);
            $user = new Users();
            $user->first_name = $request->input('firstname');
            $user->last_name = $request->input('lastname');
            $user->username = $request->input('lastname') . '_' . $request->input('firstname');
            $user->name = $request->input('firstname') . ' ' . $request->input('lastname');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->GroupID = $request->input('GroupID');
            $user->password = bcrypt($rand);
            $user->createdby = Auth::User()->id;
            $user->save();

            $logs = new AuditLog();
            $logs->username = Auth::User()->username;
            $logs->activity = "Create New User " . $request->input('username');
            $logs->status = "1";
            $logs->userID = Auth::User()->id;
            $logs->save();
            $data = array('email' => $request->input('email'), 'password' => $rand);
            Mail::send('emails.signup', ['data' => $data], function ($message) use ($request) {
                $message->to($request->input('email'), $request->input('firstname') . ' ' . $request->input('lastname'))->subject('KFCB Rating Portal Registration');
                $message->cc('kiprop.larry@gmail.com', 'KFCB Rating Portal');
                $message->from('noreply@kfcb.com', 'KFCB Rating Portal');
            });
            return response()->json([
                'success' => false,
                'status' => '00',
                'message' => '<code>' . $user->name . '</code>' . ' Created Successfully'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $user = Users::find($id);
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $user = Users::find($id);
//        $groups = DB::table('groups')->pluck('groupname', 'id');
        return view('user.edit')->with(['user' => $user]);

    }

    public function getUserById($id)
    {
        $user = Users::find($id);
        return json_encode($user);
    }

    public function activate(Request $request)
    {
        $validator = Validator::make(Input::All(), [
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'status' => '01',
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $user = Users::find(Input::get('id'));
            $user->status = Input::get('updatestatus');
            $user->createdby = Auth::User()->id;
            $user->save();
            return response()->json([
                'success' => false,
                'status' => '00',
                'message' => '<code> User </code> Activated Successfully'
            ]);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(Input::All(), [
            'username' => 'required',
            'email' => 'required|email|max:255|',
        ]);
        if ($validator->fails()) {
            //Record Audit Logs
            $logs = new AuditLog();
            $logs->username = Auth::User()->username;
            $logs->activity = "Create Film; Validation error ";
            $logs->status = "0";
            $logs->userID = Auth::User()->id;
            $logs->save();
            return response()->json([
                'success' => false,
                'status' => '01',
                'errors' => $validator->errors()->toArray()
            ]);
        } else {
            $user = Users::find(Input::get('id'));
            if (Input::get('updater') == 2) {
                $user->status = $request->input('updatestatus');
                $user->deactivatedby = Auth::User()->id;
                $user->save();
            } elseif (Input::get('updater') == 3) {
                $user->status = $request->input('updatestatus');
                $user->activatedby = Auth::User()->id;
                $user->save();
            } else {
                $user->first_name = $request->input('firstname');
                $user->last_name = $request->input('lastname');
                $user->phone = $request->input('phone');
                $user->email = $request->input('email');
                $user->GroupID = $request->input('GroupID');
                $user->username = $request->input('firstname') . '_' . $request->input('lastname');;
                $user->name = $request->input('firstname') . ' ' . $request->input('lastname');
                $user->createdby = Auth::User()->id;
                $user->save();

                $logs = new AuditLog();
                $logs->username = Auth::User()->username;
                $logs->activity = "Edit user " . $request->input('username') . "Details";
                $logs->status = "1";
                $logs->userID = Auth::User()->id;
                $logs->save();
            }
            return response()->json([
                'success' => false,
                'datainput' => $user,
                'status' => '00',
                'message' => '<code>' . $request->input('firstname') . ' ' . $request->input('lastname') . '</code>' . ' Updated Successfully'
            ]);
        }
    }

    public function getUsers($status)
    {
        $users = DB::table('users')->where('status', '=', $status);
        if ($status == 1) {
            $action = '<div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">Action <span class="caret"></span></button>
                            <ul class="dropdown-menu">

                                <li><a href="#" data-toggle="modal" data-target=".bs-example-modal-edit" data-id=" {{ $id }}" class="edit">Edit</a></li>
                               <li><a href="#" data-toggle="modal" data-id=" {{ $id }}" data-name="{{$name}}" class="remove" data-target=".bs-example-modal-remove">Remove</a></li>
                            </ul>
                        </div>';
        } elseif ($status == 0) {
            $action = '<div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">Action <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="#" data-toggle="modal" data-id=" {{ $id }}" data-name="{{$name}}"  data-target=".bs-example-modal-edit" data-id=" {{ $id }}" class="edit">Edit</a></li>
                                <li><a href="#" data-toggle="modal" data-id=" {{ $id }}" data-name="{{$name}}" class="remove" data-target=".bs-example-modal-remove">Remove</a></li>
                                <li><a href="#"  data-toggle="modal" data-id=" {{ $id }}" data-name="{{$name}}"  data-target=".bs-example-modal-approve" class="activate">Approve</a></li>
                            </ul>
                        </div>';
        } elseif ($status == 3) {
            $action = '<div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">Action <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="#" data-toggle="modal" data-id=" {{ $id }}" data-name="{{$name}}"  data-target=".bs-example-modal-edit">Edit</a></li>
                                <li><a href="#" data-toggle="modal" data-id=" {{ $id }}" data-name="{{$name}}" class="remove"  data-target=".bs-example-modal-remove">Remove</a></li>
                                <li><a href="#"  data-toggle="modal" data-id=" {{ $id }}" data-name="{{$name}}"  data-target=".bs-example-modal-activate">Activate</a></li>
                                </ul>
                        </div>';
        } elseif ($status == 4) {
            $action = '<div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">Action <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                               <li><a href="#" data-toggle="modal" data-target=".bs-example-modal-deny">Delete Permanently</a></li>
                               <li><a href="#"  data-toggle="modal" data-id=" {{ $id }}" data-name="{{$name}}" class="reactivate"  data-target=".bs-example-modal-reactivate">Re-Activate</a></li>
                               </ul>
                        </div>';
        }

        $users = DB::table('users')
            ->join('groups', 'users.GroupID', '=', 'groups.id')
            ->where('users.status', '=', $status)
            ->select('users.*', 'groups.groupname');
        return Datatables::of($users)
            ->editColumn('id', "{{ \$id }}")
            ->addColumn('actions', $action)
            ->rawColumns(['actions', 'created_at'])
            ->make(true);
    }

}
