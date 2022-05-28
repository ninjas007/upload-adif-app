<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class CronJobController extends Controller
{
    public function index()
    {
    	$users = User::where('life_time', 0)->where('category', 'premium')->get();

        $return['users'] = [];
    	foreach ($users as $user) {
            // waktu satu tahun dari masa daftarnya
            $date = date('Y-m-d', strtotime('+335 day', strtotime($user->register)));
            $duaBulanTerakhir = date('Y-m-d', strtotime('-2 month', strtotime($date)));

    	    $data = [
                    'nama' => $user->name,
                    'kategori' => $user->category,
                    'callsign' => $user->callsign,
                    'class_premium' => $user->class_premium,
                    'tanggal_expired' => $date,
                ];

            // pemberitahuan sebelum habis waktunya

            // jika hari ini adalah satu tahun dari masa daftarnya
            // artinya dia expired
            if ($date == date('Y-m-d')) {

                \Mail::to($user->email)->send(new \App\Mail\ExpiredMail($data));
                $return['users'][] = [
                    'name' => $user->name,
                    'category' => $user->category,
                    'callsign' => $user->callsign,
                    'no_hp' => $user->no_hp
                ];

                // update membernya jadi tidak aktif
                $this->updateMemberTidakAktif($user->id);
            }

            // jika masa daftarnya yg ditambah satu tahun tadi kurang dari dua bulan
            // kirim notifikasi 2 bulan terakhir
            if($duaBulanTerakhir == date('Y-m-d')) {
                \Mail::to($user->email)->send(new \App\Mail\TwoMonthNotificationMail($data));
                $return['users'][] = [
                    'name' => $user->name,
                    'category' => $user->category,
                    'callsign' => $user->callsign,
                    'no_hp' => $user->no_hp
                ];
            }
    	}

    	$return['count'] = count($return['users']);
    	if($return['count'] > 0) {
    	    \Mail::to(User::find(1)->first()->email)->send(new \App\Mail\ExpiredAdminNotifMail($return));
    	}

    }

    private function updateMemberTidakAktif($user_id)
    {
        $u = User::findOrFail($user_id);
        $u->active = 0;
        $u->updated_at = date('Y-m-d H:i:s');

        $u->save();
    }
}
