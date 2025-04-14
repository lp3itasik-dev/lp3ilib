<?php

namespace App\Http\Controllers;

use App\Models\DetailRepo;
use App\Models\Inputrepo;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;

class InputkknController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $repositories = Inputrepo::all();
        $types = Type::all();
        $users = User::where('role', 'D')->get();
        // $types = Type::where('id', 1)->first();
        return view('inputkkn')->with([
            'repositories'=>$repositories,
            'types'=>$types,
            'users'=>$users
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
        $series = $request->input('series');
        $nama_kelompok = $request->input('nama_kelompok');
        $nama_mhss = $request->input('nama_mahasiswa', []);
        $nims = $request->input('nim', []);
        $majors = $request->input('program_studi', []);
        $tahun_angkatan = $request->input('tahun_angkatan');

        foreach ($nama_mhss as $index => $nama_mhs) {
            $dataa = [
                'series' => $series,
                'nama_kelompok' => $nama_kelompok,
                'nama_mhs' => $nama_mhs,
                'nim' => $nims[$index],
                'major' => $majors[$index],
                'tahun_angkatan' => $tahun_angkatan,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            DetailRepo::create($dataa);
        }

        return back()->with('message_delete','Data Lowongan Sudah dihapus');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
