<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class UnratedController extends Controller
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
        return view('moderator.unrated');
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
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getFilmsList()
    {
        $films = DB::table('films')->where('rated', 1);
        $action = '<a href="' . url("reviewrate/" . '{{ $id }}') . '"   data-id=" {{ $id }}" data-name="{{$name}}" class="btn btn-xs blue"> Review Ratings </a>';
        return Datatables::of($films)
            ->editColumn('id', "{{ \$id }}")
            ->addColumn('actions', $action)
            ->rawColumns(['rated', 'actions', 'poster', 'created_at'])
            ->make(true);
    }
}
