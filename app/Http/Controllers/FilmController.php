<?php

namespace App\Http\Controllers;

use App\AuditLog;
use App\Film;
use App\FilmExaminer;
use App\Http\Requests;
use App\Users;
use Auth;
use Datatables;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;

class FilmController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = DB::table('category')->pluck('name', 'name');
        $genres = DB::table('genres')->pluck('name', 'name');
        $examiner = DB::table('users')->where('GroupID', 3)->pluck('name', 'id');
        return view('films/index', compact('genres', 'category', 'examiner'));
    }

    public function filmSynopsis()
    {
        $users = Users::where('GroupID', 3)->get();
        $genre = DB::table('genres')->pluck('name', 'name');
        $category = DB::table('category')->pluck('name', 'name');
        return view('films/synopsis', compact('genre', 'category', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('films/create');
    }

    public function video(Request $request)
    {

        //upload an image to the /img/tmp directory and return the filepath.

        $file = Input::file('file1');
        $filmID = $request->input('id');
        $filmName = $request->input('name');
        $tmpFilePath = '/uploads/film/Videos' . $filmName;
        $tmpFileName = $file->getClientOriginalName();
        $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
        $path = $tmpFilePath . $tmpFileName;

        $film = Film::find($filmID);
        $film->clip = '1';
        $film->clipname = $tmpFileName;
        $film->clip_path = $tmpFilePath . '/' . $tmpFileName;
        if ($film->save()) {


            echo "$tmpFileName upload is complete";
        } else {
            echo "ERROR: Please browse for a file before clicking the upload button.";
        }
    }

    public function poster(Request $request)
    {
        if (Input::hasFile('file')) {
            //upload an image to the /img/tmp directory and return the filepath.

            $file = Input::file('file');
            $filmID = $request->input('posterFilmID');
            $filmName = $request->input('posterFilmName');
            $tmpFilePath = '/uploads/film/posters/' . $filmName;
            $tmpFileName = $file->getClientOriginalName();
            $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
            $path = $tmpFilePath . $tmpFileName;

            $film = Film::find($filmID);
            $film->poster = 'Yes';
            $film->posteruploaded = 1;
            $film->postername = $tmpFileName;
            $film->path = $tmpFilePath . '/' . $tmpFileName;
            $film->save();


            return response()->json(array('path' => $path), 200);
        } else {
            return response()->json(false, 200);
        }
    }

    public function ratedfilms()
    {
        return view('films.rated');
    }

    public function assignExaminers()
    {
        $users = Users::where('GroupID', 3)->get();
        return view('films.filmexaminers', compact('users'));
    }

    public function filmsExaminers($id)
    {
        $users = Users::where('GroupID', 3)
            ->orWhere('GroupID', 4)
            ->orderBy('GroupID', 'asc')
            ->get();
        $films = Film::findOrFail($id);
        return view('films.filmexams', compact('users', 'films'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:films|max:255',
            'length' => 'required',
        ]);
        $film = new Film();
        $film->name = $request->input('name');
        $film->category = $request->input('category');
        $film->length = $request->input('length');
        $film->origin = $request->input('origin');
        $film->genre = $request->input('genre');
        $film->producer = $request->input('producer');
        $film->synopsis_examiner = $request->input('producer');
        $film->venue = $request->input('venue');
        $film->poster = $request->input('poster');
        $film->year_of_production = $request->input('year_of_production');
        $film->description = $request->input('name') . ': From ' . $request->input('origin') . ' By ' . $request->input('producer');
        $film->createdby = Auth::User()->id;
        $film->synopsis_examiner = $request->input('examiner');
        $film->save();

        $logs = new AuditLog();
        $logs->username = Auth::User()->username;
        $logs->activity = "Create Film New Film";
        $logs->status = "1";
        $logs->userID = Auth::User()->id;
        $logs->save();

        $this_film = DB::table('films')->where('name', '=', $request->input('name'))->first();
        $name = $this_film->name;
        $filmID = $this_film->id;
        $examiner = $request->input('examiner');

        DB::insert('insert into synopsis_examiners (userID, filmID) values (?, ?)', [$examiner, $filmID]);

        $users = DB::table('users')->where('GroupID', 3)->orWhere('GroupID', 4)->get();;

        foreach ($users as $user) {
            DB::insert('insert into film_examiners (userID, filmID) values (?, ?)', [$user->id, $filmID]);
        }

        return response()->json([
            'success' => false,
            'status' => '00',
            'message' => '<code>' . $name . '</code>' . ' Created Successfully'
        ]);


    }

    public function getFilmsList()
    {
        $action = '<div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">Action <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                               <div class="clearfix"></div>
                               <li><a href="#" data-toggle="modal" data-target=".bs-example-modal-edit" data-id=" {{ $id }}" class="edit">Edit</a></li>
                                <div class="clearfix"></div>
                                @if($rated===2)
                                    <li><a href="' . url("certificate/print/" . '{{ $id }}') . '"   data-id=" {{ $id }}" data-name="{{$name}}" class="class="btn btn-primary viewToEditBtn">Film Certificate</button></li>
                                @endif
                                <div class="clearfix"></div>
                                @if($posterrated==1)
                                    <li><a href="' . url("certificate/poster/" . '{{ $id }}') . '"   data-id=" {{ $id }}" data-name="{{$name}}" class="class="btn btn-primary viewToEditBtn">Poster Certificate</button></li>
                                @endif
                                <div class="clearfix"></div>
                                @if($rated===0)
                                <li><a href="#" data-toggle="modal" data-target=".bs-example-modal-upload" data-id=" {{ $id }}" data-name="{{$name}}" data-sname="{{$name}}" class="upload">Upload Film</a></li>
                                    @if($poster=="Yes")
                                        @if($posteruploaded==0)
                                        <li><a href="#" data-toggle="modal" data-target=".bs-example-modal-poster" data-id=" {{ $id }}" data-name="{{$name}}" class="poster">Upload Poster</a></li>
                                        @elseif($posteruploaded==1)
                                        <li><a href="#" data-toggle="modal" data-target=".bs-example-modal-poster" data-id=" {{ $id }}" data-name="{{$name}}" class="poster">Update Poster</a></li>
                                    @endif
                                    @endif
                                @endif
                                <div class="clearfix"></div>
                            </ul>
                        </div>';
        $films = DB::table('films')->orderBy('created_at', 'desc');
        return Datatables::of($films)
            ->editColumn('rated', '@if($rated==0)
                                <span class="badge badge-default">Awaiting Rating</span>
                            @elseif($rated==1)
                                <span class="badge badge-primary">Awaiting Moderation</span>
                            @elseif($rated==2)
                                <span class="badge badge-success">Rating Successful</span>
                            @elseif($rated==3)
                                <code class="badge badge-danger">Rectected</code>
                            @endif')
            ->editColumn('poster', '@if($poster=="Yes")
                                <span class="badge badge-success">YES</span>
                                @if($posteruploaded==1)
                                    <button data-toggle="modal" data-target=".bs-example-modal-viewposter" data-id=" {{ $id }}" data-name="{{$name}}" data-poster="{{$path}}"  class="btn btn-circle btn-success btn-xs viewposter">View Poster</button>
                                 @elseif($posteruploaded==0)
                                    <button class="btn btn-circle btn-danger btn-xs poster" data-toggle="modal" data-target=".bs-example-modal-poster" data-id=" {{ $id }}" data-name="{{$name}}" >Upload Img</button>
                                 @endif
                            @elseif($poster=="No")
                                <span class="badge badge-danger">NO</span>
                            @endif')
            ->editColumn('id', "{{ \$id }}")
//            ->editColumn('created_at', date("H:i d/m/y", "{{\$created_at}}"))
            ->addColumn('actions', $action)
            ->make(true);
    }

    public function getFilmsExaminers()
    {
        $action = '<div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">Action <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <div class="clearfix"></div>
                                @if($rated==0)
                                    <li><a href="' . url("examiner/" . '{{ $id }}') . '"   data-id=" {{ $id }}" data-name="{{$name}}" class="class="btn btn-primary viewToEditBtn">View/Assign Examiner</button></li>
                                @endif
                                <div class="clearfix"></div>
                            </ul>
                        </div>';
        $films = DB::table('films')->where('rated', 0);
        return Datatables::of($films)
            ->editColumn('rated', '@if($rated==0)
                                <span class="badge badge-default">Awaiting Rating</span>
                            @elseif($rated==1)
                                <span class="badge badge-primary">Awaiting Moderation</span>
                            @elseif($rated==2)
                                <span class="badge badge-success">Rating Successful</span>
                            @elseif($rated==3)
                                <code class="badge badge-danger">Rectected</code>
                            @endif')
            ->editColumn('id', "{{ \$id }}")
            ->addColumn('actions', $action)
            ->make(true);
    }

    public function getRatedFilmsList()
    {
        $films = DB::table('films')->where('rated', 1);
        $action = '<div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle">Action <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="' . url("rate/page1/" . '{{ $id }}') . '"   data-id=" {{ $id }}" data-name="{{$name}}" class="class="btn btn-primary viewToEditBtn">View Rate Film</button></li>
                            </ul>
                        </div>';

        return Datatables::of($films)
            ->editColumn('id', "{{ \$id }}")
            ->addColumn('actions', $action)
            ->make(true);
    }

    public function getFilmsExaminersByID($id)
    {
        $films = DB::table('film_examiners')
            ->join('users', 'users.id', '=', 'film_examiners.userID')
            ->where('film_examiners.filmID', $id)
            ->select('users.*', 'film_examiners.userID');
        $action = '<div class="mt-checkbox-list"><a href="#" id="checkMe" class="btn green btn-solid btn-xs sbold uppercase checkMe" data-id=" {{ $id }}" data-name="{{$name}}" data-token="{{ csrf_token() }}" >REMOVE</a></div>';
        return Datatables::of($films)
            ->editColumn('id', "{{ \$id }}")
            ->addColumn('actions', $action)
            ->make(true);
    }

    public function storeFilmExaminer(Request $request)
    {
        $rate = FilmExaminer::firstOrNew(array('userID' => Input::get('userID'), 'filmID' => Input::get('filmID')));
        $rate->filmID = $request->input('filmID');
        $rate->userID = $request->input('userID');
        $rate->status = 0;
        $rate->save();

        $logs = new AuditLog();
        $logs->username = Auth::User()->username;
        $logs->activity = "Added Parameter <code> " . $request->input('name') . "</code>";
        $logs->status = "1";
        $logs->userID = Auth::User()->id;
        $logs->save();
        return response()->json([
            'success' => false,
            'status' => '00',
            'message' => '<code>' . $request->input('name') . '</code> Saved'
        ]);
    }

    public function removeFilmExaminer(Request $request)
    {
        $filmID = $request->input('filmID');
        $name = $request->input('name');
        $userID = $request->input('userID');

        if (DB::table('film_examiners')
            ->where('filmID', $filmID)
            ->where('userID', $userID)
            ->delete()) {
            $logs = new AuditLog();
            $logs->username = Auth::User()->username;
            $logs->activity = "Deleted Examiner <code> " . $request->input('name') . "</code>";
            $logs->status = "1";
            $logs->userID = Auth::User()->id;
            $logs->save();
            return response()->json([
                'success' => false,
                'status' => '00',
                'message' => '<code>' . $name . '</code> Deleted'
            ]);
        } else {
            $logs = new AuditLog();
            $logs->username = Auth::User()->username;
            $logs->activity = "Delete Examiner <code> " . $request->input('name') . "</code>";
            $logs->status = "0";
            $logs->userID = Auth::User()->id;
            $logs->save();
            return response()->json([
                'success' => false,
                'status' => '01',
                'message' => '<code>' . $name . '</code> Not Deleted'
            ]);
        }


    }

    //get the bank details by id
    public function getEditData($id)
    {
        $group = Film::find($id);
        return json_encode($group);
    }

    public function removeExaminer(Request $request)
    {
        $filmID = $request->input('filmID');
        $userID = $request->input('userID');
        //  DB::table('film_examiners')->where('userID', '=', $userID)->where('filmID', '=', $filmID)->delete();
        if (DB::table('film_examiners')
            ->where('filmID', $filmID)
            ->where('userID', $userID)
            ->delete()) {
            return response()->json([
                'success' => true,
                'status' => '00',
                'message' => ' Deleted Successfully'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'status' => '01',
                'message' => 'Not Successful'
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(Input::All(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            //Record Audit Logs
            $logs = new AuditLog();
            $logs->username = Auth::User()->username;
            $logs->activity = "Edit Film; Validation error ";
            $logs->status = "0";
            $logs->userID = Auth::User()->id;
            $logs->save();
            return response()->json([
                'success' => false,
                'status' => '01',
                'errors' => $validator->errors()->toArray()
            ]);
        } else {
            $film = Film::find(Input::get('id'));
            if (Input::get('updater') == 2) {
                $film->status = $request->input('updatestatus');
                $film->deactivatedby = Auth::User()->id;
                $film->save();
            } elseif (Input::get('updater') == 3) {
                $film->status = $request->input('updatestatus');
                $film->activatedby = Auth::User()->id;
                $film->save();
            } else {
                $film->name = $request->input('name');
                $film->category = $request->input('category');
                $film->length = $request->input('length');
                $film->origin = $request->input('origin');
                $film->genre = $request->input('genre');
                $film->producer = $request->input('producer');
                $film->poster = $request->input('poster');
                $film->year_of_production = $request->input('year_of_production');
                $film->description = $request->input('description');
                $film->updatedby = Auth::User()->id;
                $film->updated_at = strtotime("now");
                $film->save();

                $logs = new AuditLog();
                $logs->username = Auth::User()->username;
                $logs->activity = "Edit film <code>" . $request->input('name') . "</code> details";
                $logs->status = "1";
                $logs->userID = Auth::User()->id;
                $logs->save();
            }
            return response()->json([
                'success' => false,
                'datainput' => $film,
                'status' => '00',
                'message' => '<code>' . Input::get('name') . '</code>' . ' Updated Successfully'
            ]);
        }
    }
}
