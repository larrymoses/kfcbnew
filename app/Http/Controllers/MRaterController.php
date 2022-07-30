<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Film;
use Auth;
use Datatables;
use DB;

class MRaterController extends Controller
{
    public function __construct()
    {
        $this->middleware(array('auth'));
    }

    public function index()
    {
        return view('mrater.index');
    }

    public function rate_poster()
    {
        return view('mrater.poster');
    }

    public function rate($id)
    {
        $synopsis = DB::table('films')->where('id', $id)->value('synopsis_examiner');
        $me = Auth::User()->id;
        $film = Film::find($id);
        return view('mrater.rate', compact('film', 'synopsis', 'me'));
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
        $action = '<a href="' . url("/mrate/" . '{{ $id }}') . '"  class="btn btn-primary btn-xs">Start Rate</a>';
        return Datatables::of($films)
            ->editColumn('id', "{{ \$id }}")
            ->addColumn('actions', $action)
            ->rawColumns(['rated', 'actions', 'poster', 'created_at'])
            ->make(true);
    }
}
