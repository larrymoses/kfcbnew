<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Http\Requests;
use Auth;
use Datatables;
use DB;
use Illuminate\Support\Facades\Input;
use Mail;
use Validator;

class MuserController extends Controller
{
    public function __construct()
    {
        $this->middleware(array('auth'));
    }

    public function index()
    {
        $groups = DB::table('groups')->where('id', '>', 2)->pluck('groupname', 'id');
        return view('users.mindex', compact('groups'));
    }

    public function getUsers($status)
    {
//        $users = DB::table('users')->where('GroupID','>',2)->where('status', '=', $status);
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
                               <li><a href="#" data-toggle="modal" data-target=".bs-example-modal-deny">Deny</a></li>
                               <li><a href="#"  data-toggle="modal" data-target=".bs-example-modal-approve">Approve</a></li>
                               </ul>
                        </div>';
        }

        $users = DB::table('users')
            ->join('groups', 'users.GroupID', '=', 'groups.id')
            ->where('groups.id', '>', 2)
            ->where('users.status', '=', $status)
            ->select('users.*', 'groups.groupname');
        return Datatables::of($users)
            ->editColumn('id', "{{ \$id }}")
            ->addColumn('actions', $action)
            ->make(true);
    }
}
