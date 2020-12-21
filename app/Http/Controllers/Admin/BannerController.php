<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Banner;
use Auth;

class BannerController extends Controller
{
    private function checkAdmin()
    {
        if (Auth::user()->manager == 1 && Auth::user()->category == 'admin') {
            echo 'Bukan super admin';
            die;
        }
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->checkAdmin();
        
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
        $this->checkAdmin();
        
        $data['banner'] = Banner::findOrFail($id);

        return view('admin.banner.edit', $data);
    }
}
