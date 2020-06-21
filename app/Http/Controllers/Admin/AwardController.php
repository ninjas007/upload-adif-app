<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Award;
use App\UserAward;
use Validator;
use Uuid;

class AwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $awards = Award::paginate(10);

        return view('admin.award.index', compact('awards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.award.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required|max:100',
            'url_gambar' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('admin/award/tambah')->withErrors($validator->errors());
        }

        $award = Award::create([
            'uuid' => Uuid::generate(4),
            'nama' => $request->nama,
            'url_award' => $request->url_award,
            'url_gambar' => $request->url_gambar,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $award->save();

        return redirect('admin/awards')->with('success', 'Berhasil menambah award');

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
    public function edit($uuid)
    {
        $award = Award::where('uuid', $uuid)->first();

        return view('admin.award.edit', compact('award'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $rules = [
            'nama' => 'required|max:100',
            'url_gambar' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('admin/awards/ubah/'.$uuid.'')->withErrors($validator->errors());
        }

        $award = Award::where('uuid', $uuid)->first();
        $award = Award::findOrFail($award->id);

        $award->uuid = $uuid;
        $award->nama = $request->nama;
        $award->url_award = $request->url_award;
        $award->url_gambar = $request->url_gambar;
        $award->updated_at = date('Y-m-d H:i:s');

        $award->save();

        return redirect('admin/awards')->with('success', 'Berhasil mengubah award');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $award = Award::findOrFail($id);
        $userAward = UserAward::where('award_id', $id)->first();

        if ($userAward) {
            return redirect('admin/awards')->with('error', 'Award ini memiliki relasi dengan user. Tidak dapat dihapus!');
        }

        $award->delete();

        return redirect('admin/awards')->with('success', 'Berhasil menghapus award');
    }
}
