<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\AuditLog;
use App\Models\ThemeParam;
use App\Models\Themes;
use Auth;
use Datatables;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function themes()
    {
        return view('settings.themes');
    }

    public function raterProfile()
    {
        return view('settings.rater');
    }

    public function raterProfilePost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|max:255',
            'newpassword' => 'required|max:255',
            'confirm_newpassword' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return redirect('profile/post')
                ->withErrors($validator)
                ->withInput();
        }

    }

    public function themesbyID($id)
    {
        $group = Theme::find($id);
        return json_encode($group);
    }

    public function parameters()
    {
        $themes = DB::table('themes')->pluck('name', 'name');
        return view('settings.parameters', compact('themes'));
    }

    public function getParameters()
    {
        $parameters = DB::table('parameters');
        $action = '<div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">Action <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                             <li><a href="#" data-toggle="modal" data-target=".bs-example-modal-edit" data-id=" {{ $id }}" class="edit">Edit</a></li>
                           </ul>
                        </div>';
        return Datatables::of($parameters)
            ->editColumn('id', "{{ \$id }}")
            ->addColumn('actions', $action)
            ->rawColumns(['actions', 'created_at'])
            ->make(true);
    }

    public function getThemes()
    {
        $themes = Themes::all();
        $action = '<div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">Action <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                             <li><a href="#" data-toggle="modal" data-target=".bs-example-modal-edit" data-id=" {{ $id }}" class="edit">Edit</a></li>
                           </ul>
                        </div>';
        return Datatables::of($themes)
            ->editColumn('id', "{{ \$id }}")
            ->addColumn('actions', $action)
            ->rawColumns(['actions', 'created_at'])
            ->make(true);
    }

    public function saveThemes(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:themes|max:255',
        ]);
        $film = new Themes();
        $film->name = $request->input('name');
        $film->description = $request->input('description');
        $film->createdby = Auth::User()->id;
        $film->save();

        $logs = new AuditLog();
        $logs->username = Auth::User()->username;
        $logs->activity = "Create Theme <code>:" . $request->input('name') . "</code>";
        $logs->status = "1";
        $logs->userID = Auth::User()->id;
        $logs->save();


        return response()->json([
            'success' => false,
            'status' => '00',
            'message' => '<code>' . Input::get('name') . '</code>' . ' Created Successfully'
        ]);


    }

    public function saveparameters(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:parameters|max:255',
        ]);
        //get themeID
        $themeID = DB::table('themes')->where('name', $request->input('theme'))->value('id');
        $film = new ThemeParam();
        $film->name = $request->input('name');
        $film->themeID = $themeID;
        $film->theme = $request->input('theme');
        $film->description = $request->input('description');
        $film->createdby = Auth::User()->id;
        $film->save();

        $logs = new AuditLog();
        $logs->username = Auth::User()->username;
        $logs->activity = "Create Parameter <code>:" . $request->input('name') . "</code>";
        $logs->status = "1";
        $logs->userID = Auth::User()->id;
        $logs->save();


        return response()->json([
            'success' => false,
            'status' => '00',
            'message' => '<code>' . Input::get('name') . '</code>' . ' Created Successfully'
        ]);


    }

    public function updateThemes(Request $request, $id)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);
        $film = Theme::findOrFail($id);
        $film->name = $request->input('name');
        $film->description = $request->input('description');
        $film->createdby = Auth::User()->id;
        $film->save();

        $logs = new AuditLog();
        $logs->username = Auth::User()->username;
        $logs->activity = "Update Theme <code>:" . $request->input('name') . "</code>";
        $logs->status = "1";
        $logs->userID = Auth::User()->id;
        $logs->save();


        return response()->json([
            'success' => false,
            'status' => '00',
            'message' => '<code>' . Input::get('name') . '</code>' . ' Updated Successfully'
        ]);


    }
}
