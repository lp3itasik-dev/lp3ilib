<?php

namespace App\Http\Controllers;

use App\Models\Repositories;
use Illuminate\Http\Request;

class SearchrepoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchVal = request('search');
        $repositories = Repositories::where('title', 'LIKE','%'.$searchVal.'%')->get();
        $filtered = Repositories::groupBy('major')->select('major')->get();
        return view('src')->with([
            'repositories' => $repositories,
            'filtered' => $filtered,
        ]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $searchrepo)
    {
        $repositories = Repositories::where('type_id', $id)
            ->where('major', $searchrepo)
            ->get();
            $filtered = Repositories::whereNotNull('major')
            ->groupBy('major')
            ->select('major')
            ->get();
        return view('search')->with([
            'repositories' => $repositories,
            'filtered' => $filtered,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $repositories = Repositories::where('type_id', $id)->get();
        // $filtered = Repositories::groupBy('major')->select('major')->get();
        $filtered = Repositories::whereNotNull('major')
                    ->groupBy('major')
                    ->select('major')
                    ->get();
        return view('search')->with([
            'repositories' => $repositories,
            'filtered' => $filtered,
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
