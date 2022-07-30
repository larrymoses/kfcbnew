<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\AuditLog;
use App\Models\Film;
use App\Models\RatedMe;
use App\Models\Rating;
use App\Models\TempRate;
use App\Models\ThemeOccurance;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Yajra\Datatables\Datatables;

class RatersController extends Controller
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
        return view('raters.index');
    }

    public function rate_poster()
    {
        return view('raters.poster');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        return view('raters.history');
    }

    public function getFilmsRatrPerUser($id)
    {
        return view('raters.getdetails');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $validator = Validator::make(Input::All(), [
            'ratescore' => 'required',
        ]);
        if ($validator->fails()) {
            $logs = new AuditLog();
            $logs->username = Auth::User()->username;
            $logs->activity = "Film rating: Validation error ";
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
            $rating = new Rating();
            $rating->filmID = $filmID;
            $rating->one = $request->input('one');
            $rating->two = $request->input('two');
            $rating->three = $request->input('three');
            $rating->four = $request->input('four');
            $rating->five = $request->input('five');
            $rating->six = $request->input('six');
            $rating->ratescore = $request->input('ratescore');
            $rating->synopsis = $request->input('synopsis');
            $rating->comment = $request->input('comment');
            $rating->system = $request->input('system');
            $rating->userID = Auth::User()->id;
            $rating->save();

            // update films table
            DB::table('films')
                ->where('id', $filmID)
                ->update(['ratedby' => Auth::User()->id, 'rated' => 1]);
            DB::table('film_examiners')->where('filmID', $filmID)->where('userID', Auth::User()->id)->update(['status' => 1]);
            $byme = new RatedMe();
            $byme->filmID = $filmID;
            $byme->userID = Auth::User()->id;
            $byme->save();

            $logs = new AuditLog();
            $logs->username = Auth::User()->username;
            $logs->activity = "Rated Film " . $filmName . " success";
            $logs->status = "1";
            $logs->userID = Auth::User()->id;
            $logs->save();

            return response()->json([
                'success' => false,
                'status' => '00',
                'message' => 'Congratulations! Rating Completed'
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function storeTimeOccurance(Request $request)
    {
        $occure = new ThemeOccurance();
        $occure->filmID = $request->input('filmID');
        $occure->themeID = $request->input('themeID');
        $occure->time_at = $request->input('time_at');
        $occure->userID = $request->input('userID');
        if ($occure->save()) {
            return "saved";
        }
    }

    public function storeRate(Request $request)
    {
        $rate = TempRate::firstOrNew(array('paramID' => Input::get('paramID'), 'filmID' => Input::get('filmID')));
        $rate->filmID = $request->input('filmID');
        $rate->paramID = $request->input('paramID');
        $rate->name = $request->input('name');
        $rate->userID = Auth::User()->id;
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

    public function store_poster_rate(Request $request, $id)
    {
        $rate = Film::findOrFail($id);
        $rate->posterComment = $request->input('comment');
        $rate->posterRate = $request->input('ratescore');
        $rate->posterrated = 1;
        $rate->posterRatedBy = Auth::User()->id;
        $rate->save();

        $logs = new AuditLog();
        $logs->username = Auth::User()->username;
        $logs->activity = "Rated Poster <code> " . $request->input('ratescore') . "</code>";
        $logs->status = "1";
        $logs->userID = Auth::User()->id;
        $logs->save();
        return response()->json([
            'success' => false,
            'status' => '00',
            'message' => '<code>' . $request->input('name') . '</code> Saved'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function removerate(Request $request)
    {
        $filmID = $request->input('filmID');
        $paramID = $request->input('paramID');
        $name = $request->input('name');
        $userID = Auth::User()->id;

        if (DB::table('rating_params')
            ->where('filmID', $filmID)
            ->where('paramID', $paramID)
            ->where('userID', $userID)
            ->delete()) {
            $logs = new AuditLog();
            $logs->username = Auth::User()->username;
            $logs->activity = "Deleted Parameter <code> " . $request->input('name') . "</code>";
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
            $logs->activity = "Delete Parameter <code> " . $request->input('name') . "</code>";
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

    public function getParameter($id)
    {
        $parameter = DB::table('parameters')->where('themeID', $id);
        $action = '<div class="mt-checkbox-list"><input type="checkbox" id="checkMe" class="checkMe" data-id=" {{ $id }}" data-name="{{$name}}" data-token="{{ csrf_token() }}" ></div>';
        return Datatables::of($parameter)
            ->editColumn('id', "{{ \$id }}")
            ->addColumn('actions', $action)
            ->make(true);
    }

    public function getUserParameter()
    {
        $user = Auth::User()->id;
        $film = 1;

        $parameter = DB::table('rating_params')->where('userID', $user);
        $action = '<a href="' . url("/rate/" . '{{ $id }}') . '"  class="btn btn-primary btn-xs">Start Rate</a>';
        return Datatables::of($parameter)
            ->editColumn('id', "{{ \$id }}")
            ->addColumn('actions', $action)
            ->make(true);
    }

    public function rate($id)
    {
        $synopsis = DB::table('films')->where('id', $id)->value('synopsis_examiner');
        $me = Auth::User()->id;
        $film = Film::find($id);
        return view('raters.rate', compact('film', 'synopsis', 'me'));
    }

    public function poster_rate($id)
    {
        $synopsis = DB::table('films')->where('id', $id)->value('synopsis_examiner');;
        $film = Film::find($id);
        return view('raters.rate_poster', compact('film', 'synopsis'));
    }

    public function getFilmsList()
    {
        $id = Auth::User()->id;

        $films = DB::table('films')
            ->join('film_examiners', 'films.id', '=', 'film_examiners.filmID')
            ->where('film_examiners.userID', $id)
            ->where('film_examiners.status', 0)
            ->where('films.rated', 0)
            ->select('films.*');
        $action = '<a href="' . url("/rate/" . '{{ $id }}') . '"  class="btn btn-primary btn-xs">Start Rate</a>';
        return Datatables::of($films)
            ->editColumn('id', "{{ \$id }}")
            ->addColumn('actions', $action)
            ->rawColumns(['rated', 'actions', 'poster', 'created_at'])
            ->make(true);
    }

    public function getMyRatingHistory()
    {
        $id = Auth::User()->id;

        $films = DB::table('films')
            ->join('film_examiners', 'films.id', '=', 'film_examiners.filmID')
            ->where('film_examiners.userID', $id)
            ->where('film_examiners.status', 1)
            ->select('films.*');
        $action = '<a href="' . url("/viewrate/" . '{{ $id }}') . '"  class="btn btn-primary btn-xs">View</a>';
        return Datatables::of($films)
            ->editColumn('id', "{{ \$id }}")
            ->addColumn('actions', $action)
            ->rawColumns(['rated', 'actions', 'poster', 'created_at'])
            ->make(true);
    }

    public function getFilmsPostersList()
    {
        // $films = DB::table('films')->where('rated',1);
        $films = DB::table('films')->where('posterrated', 0)->where('poster', 'Yes')->where('posteruploaded', 1);
        $action = '<a href="' . url("/poster_rate/" . '{{ $id }}') . '"  class="btn btn-primary btn-xs">Start Rate</a>';
        $imgpath = '<img src="' . url('/') . '{{ $path }}" width="50px" height="55px" alt="{{ $postername }}">';
        return Datatables::of($films)
            ->editColumn('id', "{{ \$id }}")
            ->addColumn('imgpath', $imgpath)
            ->addColumn('actions', $action)
            ->rawColumns(['rated', 'actions', 'poster', 'created_at'])
            ->make(true);
    }

    public function get_temp_param($id)
    {
        $user = Auth::User()->id;
        $films = DB::table('rating_params')
            ->where('userID', $user)
            ->where('filmID', $id);
        $action = '<button class="btn btn-danger btn-xs removeParam" data-id=" {{ $id }}" data-name="{{$name}}" id="removeParam">Remove</button>';
        return Datatables::of($films)
            ->editColumn('id', "{{ \$id }}")
            ->addColumn('actions', $action)
            ->rawColumns(['actions', 'created_at'])
            ->make(true);
    }

    public function get_theme_time_occurance($id)
    {
        $user = Auth::User()->id;
        $films = DB::table('theme_occurances')
            ->join('themes', 'theme_occurances.themeID', '=', 'themes.id')
            ->where('theme_occurances.userID', $user)
            ->where('theme_occurances.filmID', $id)
            ->select('theme_occurances.*', 'themes.name');
        return Datatables::of($films)
            ->editColumn('id', "{{ \$id }}")
            ->make(true);
    }
}
