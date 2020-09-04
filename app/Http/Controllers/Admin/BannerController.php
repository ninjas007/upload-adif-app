<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Banner;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['banners'] = Banner::all();

        return view('admin.banner.index', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $banner = Banner::findOrFail($id);

        $banner->name = $request->name;
        $banner->url_image = $request->url_image;
        $banner->is_active = $request->is_active;

        if ($banner->save()) {
            return redirect('admin/banners')->with('success', 'Berhasil mengupdate data banner');
        } else {
            return redirect('admin/banners')->with('error', 'Gagal mengupdate data banner');
        }

    }

    public function edit($id)
    {
        $data['banner'] = Banner::findOrFail($id);

        return view('admin.banner.edit', $data);
    }
}
