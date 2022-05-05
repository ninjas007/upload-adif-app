<?php

namespace App\Http\Middleware;

use Closure;
use App\HakAkses;

class MemberAkses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // untuk menu members
        // hak aksesnya itu hanya award, update, dan delete
        $hak_akses = HakAkses::where('user_id', auth()->user()->id)
                                ->where('menu', 'members')
                                ->first();


        $fitur_akses = json_decode($hak_akses->fitur_akses, true);

        // cek menu berdasarkan segmen urlnya
        // dia masuk fitur member award, update, atau delete
        $segment_uri = \Request::segment(3);

        // award member
        if( in_array($segment_uri, ['award-update', 'award-store', 'award-ubah', 'kirim-certificate']) ) {
            // on tidak fiturnya
            $fitur_on = in_array('award', array_keys($fitur_akses));
            if($fitur_on) {
                return $next($request);
            } else {
                return redirect()->to('/admin/members');
            }
        }

        // update member
        if( in_array($segment_uri, ['edit', 'update']) ) {
            $fitur_on = in_array('update', array_keys($fitur_akses));
            if($fitur_on) {
                return $next($request);
            } else {
                return redirect()->to('/admin/members');
            }
        }

        // delete member
        if( in_array($segment_uri, ['hapus']) ) {
            $fitur_on = in_array('delete', array_keys($fitur_akses));
            if($fitur_on) {
                return $next($request);
            } else {
                return redirect()->to('/admin/members');
            }
        }

        return $next($request);
    }
}
