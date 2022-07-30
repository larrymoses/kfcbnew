<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\AuditLog;
use App\Models\Film;
use App\Models\Moderating;
use App\Models\Rating;
use App\Models\Users;
use Auth;
use Datatables;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Validator;

class ModeratorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['all'] = DB::table('films')->count(DB::raw('DISTINCT id'));
        $data['unrated'] = DB::table('films')->where('rated', 1)->count(DB::raw('DISTINCT id'));
        $data['rated'] = DB::table('films')->where('rated', 2)->count(DB::raw('DISTINCT id'));
        $data['declined'] = DB::table('films')->where('rated', 3)->count(DB::raw('DISTINCT id'));
        return view('moderator.dashboard')
            ->with('data', $data);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ratescore' => 'required',
        ]);

        if ($validator->fails()) {
            $logs = new AuditLog();
            $logs->username = Auth::User()->username;
            $logs->activity = "Create User: Validation error ";
            $logs->status = "0";
            $logs->userID = Auth::User()->id;
            $logs->save();
            return response()->json([
                'success' => false,
                'status' => '01',
                'errors' => json_encode($validator->errors())
            ]);
        } else {
            $filmID = $request->input('filmID');
            $filmName = $request->input('filmName');
            $rating = new Moderating();
            $rating->filmID = $filmID;
            $rating->ratescore = $request->input('ratescore');
            $rating->comment = $request->input('comment');
            $rating->userID = Auth::User()->id;
            $rating->save();

            // update films table
            DB::table('films')
                ->where('id', $filmID)
                ->update([
                    'rating' => $request->input('ratescore'),
                    'moderator' => Auth::User()->id,
                    'rated' => 2
                ]);

            $logs = new AuditLog();
            $logs->username = Auth::User()->username;
            $logs->activity = "Rated Film " . $filmName . " success";
            $logs->status = "1";
            $logs->userID = Auth::User()->id;
            $logs->save();

            return response()->json([
                'success' => false,
                'status' => '00',
                'message' => 'Congradulations!<code>' . $request->input('filmName') . '</code> Moderated'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function savereject(Request $request)
    {
        $validator = Validator::make(Input::All(), [
            'reason' => 'required',

        ]);
        if ($validator->fails()) {
            $logs = new AuditLog();
            $logs->username = Auth::User()->username;
            $logs->activity = "Film Moderating, reject Film: Validation error ";
            $logs->status = "0";
            $logs->userID = Auth::User()->id;
            $logs->save();
            return response()->json([
                'success' => false,
                'status' => '01',
                'error' => json_encode($validator->errors())
            ]);
        } else {
            return response()->json([
                'success' => false,
                'status' => '00',
                'message' => 'Film Rejected'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function unrated()
    {
        $users = Users::where('GroupID', 3)->get();
        return view('moderator.new', compact('users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function chooseExaminer(Request $request, $id)
    {
//        $id=$request->input('filmid');
        $this->validate($request, [
            'userid' => 'required',
            'filmid' => 'required',

        ]);
        $film = Film::findOrFail($id);
        $film->synopsis_examiner = $request->input('userid');
        $film->save();
        return response()->json([
            'success' => false,
            'status' => '00',
            'message' => 'Examiner Added Successfully'
        ]);
    }

    public function getuseraters($id)
    {
        $data = Rating::find($id);
        return json_encode($data);
    }

    public function reviewrate($id)
    {
        $film = Film::find($id);
        $rating = DB::table('ratings')->where('filmID', $id);
        return View::make('moderator.reviewrates', compact('film', 'rating'));
    }

    public function getraters_reviews($id)
    {
        $films = DB::table('ratings')
            ->join('films', 'films.id', '=', 'ratings.filmID')
            ->join('users', 'users.id', '=', 'ratings.userID')
            ->select('ratings.*', 'users.name as username', 'films.name as filmname')
            ->where('films.id', $id);

        $action = '<a data-toggle="modal" href="#static" data-backdrop="static" data-keyboard="false" data-id=" {{ $id }}" data-name="{{$filmname}}" class="btn btn-xs blue viewRating" id="viewRating"> Use as Final Ratings </a>';
        return Datatables::of($films)
            ->editColumn('id', "{{ \$id }}")
            ->editColumn('ratescore', '@if($ratescore==0)
                                <span class="badge badge-default">0: GE (General Exhition )</span>
                            @elseif($ratescore==1)
                                <span class="badge badge-default">1: GE (General Exhition )</span>
                            @elseif($ratescore==2)
                                <span class="badge badge-primary">2: PG (Parental Guidance Recommended)</span>
                            @elseif($ratescore==3)
                                <code class="badge badge-success">3: 16 (Not Suitable to persons Under 16Yrs)</code>
                            @elseif($ratescore==4)
                                <code class="badge badge-danger">4: 18 (Restricted To Persons above 18Yrs)</code>
                            @elseif($ratescore==4)
                                <code class="badge badge-danger">5: R (Restricted)</code>v
                            @endif')
            ->editColumn('system', '@if($system==0)
                                <span class="badge badge-default">0: GE (General Exhition )</span>
                            @elseif($system==1)
                                <span class="badge badge-default">1: GE (General Exhition )</span>
                            @elseif($system==2)
                                <span class="badge badge-primary">2: PG (Parental Guidance Recommended)</span>
                            @elseif($system==3)
                                <code class="badge badge-success">3: 16 (Not Suitable to persons Under 16Yrs)</code>
                            @elseif($system==4)
                                <code class="badge badge-danger">4: 18 (Restricted To Persons above 18Yrs)</code>
                            @elseif($system==4)
                                <code class="badge badge-danger">5: R (Restricted)</code>v
                            @endif')
            ->addColumn('actions', $action)
            ->make(true);
    }

    public function get_theme_params($id)
    {
        $films = DB::table('rating_params')
            // ->join('films', 'films.id', '=', 'ratings.filmID')
            ->join('users', 'users.id', '=', 'rating_params.userID')
            ->select('rating_params.name as paramname', 'users.name as username')
            ->where('rating_params.filmID', $id);

        // $action='<a data-toggle="modal" data-target=".bs-example-modal-useRatings" data-backdrop="static" data-keyboard="false" href="#" data-id=" {{ $id }}" data-name="{{$paramname}}" class="btn btn-xs blue viewRating"> Use as Final Ratings </a>';
        return Datatables::of($films)
            ->make(true);
    }

    public function getnonratedfilmnosynopser()
    {
        $action = '
            <a href="#" class="useThis btn btn-primary btn-circle btn-xs " data-toggle="modal" data-target=".bs-example-modal-deactivate" data-id="{{ $id }}" data-name="{{$name}}" >Select Examiner </a>
        ';
        $films = DB::table('films')->where(['rated' => 0, 'synopsis_examiner' => 0]);
        return Datatables::of($films)
            ->editColumn('id', "{{ \$id }}")
            ->addColumn('actions', $action)
            ->make(true);
    }

    public function getnonratedfilms()
    {
        $action = '
            <a href="#" class="useThis btn btn-primary btn-circle btn-xs " data-toggle="modal" data-target=".bs-example-modal-deactivate" data-id="{{ $id }}" data-name="{{$name}}" >Change Examiner </a>
        ';
        $films = DB::table('films')
            ->join('users', 'users.id', '=', 'films.synopsis_examiner')
            ->select('films.*', 'users.name as username')
            ->where('rated', 0);
        return Datatables::of($films)
            ->editColumn('id', "{{ \$id }}")
            ->addColumn('actions', $action)
            ->make(true);
    }

    public function getfilmthemeoccurance($id)
    {
        $films = DB::table('theme_occurances')
            ->join('themes', 'themes.id', '=', 'theme_occurances.themeID')
            ->select('theme_occurances.*', 'themes.name as themename')
            ->where('filmID', $id);
        return Datatables::of($films)
            ->editColumn('id', "{{ \$id }}")
            ->make(true);
    }
}
