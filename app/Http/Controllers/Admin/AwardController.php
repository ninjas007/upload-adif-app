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
        $awards = Award::all();

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
            'category' => $request->category_award,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $award->save();

        return redirect('admin/awards')->with('success', 'Berhasil menambah award');

    }
    
      public function jsonAwardMembers(Request $request)
    {
        $columns = ['nama'];

        $totalData = Award::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $awards = Award::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }
        // search
        else {
            $search = $request->input('search.value');

            $awards =  Award::where('id','LIKE',"%{$search}%")
                            ->orWhere('nama', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = Award::where('id','LIKE',"%{$search}%")
                             ->orWhere('nama', 'LIKE',"%{$search}%")
                             ->count();
        }

        $data = array();
        $url = url('');

        if(!empty($awards))
        {
            foreach ($awards as $key => $award)
            {
                $nestedData['award'] = '<a href="'.$award->url_award.'" title="Klik untuk melihat award" target="_blank">'.$award->nama.'</a>';
                $nestedData['category'] = ''.strtoupper($award->category).'';
                $nestedData['image'] = '<img src="'.$award->url_gambar.'" width="100">';

                $nestedData['action'] = '<a href="'.$url.'/admin/award/ubah/'.$award->uuid.'" class="btn btn-sm btn-primary">Ubah</a>';
                $nestedData['action'] .= '<a href="'.$url.'/admin/award/hapus/'.$award->id.'" class="btn btn-sm btn-danger" onclick="return confirm(`Yakin ingin menghapus award ini?`)">Hapus</a>';

                $data[] = $nestedData;
            }
        }

        $json_data = array(
                    "draw"            => intval($request->input('draw')),
                    "recordsTotal"    => intval($totalData - 1),
                    "recordsFiltered" => intval($totalFiltered - 1),
                    "data"            => $data
                    );

        return response()->json($json_data);
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
        $award->category = $request->category_award;
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
