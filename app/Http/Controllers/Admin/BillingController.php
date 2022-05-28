<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\KirimTagihan;
use App\HakAkses;
use Auth;
class BillingController extends Controller
{
    public function index(Request $request)
    {
        $user_id = Auth::user()->id;
        $hak_akses = HakAkses::where('user_id', $user_id)->where('menu', 'billing')->first();

        if(!$hak_akses) {
            echo 'Tidak ada akses kesini';
            die;
        }

        return view('admin.billing.index');
    }

    public function create()
    {
        return view('admin.billing.create');
    }

    public function getDataJson(Request $request)
    {
        $columns = [
            'name', 'category', 'callsign', 'class_premium', 'register'
        ];

        $totalData = User::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if(empty($request->input('search.value')))
        {
            $members = User::where('id', '>', 1)
                        ->offset($start)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->get();
        }
        // search
        else {
            $search = $request->input('search.value');

            $members =  User::where('id', '>', 1)
                            ->where('id','LIKE',"%{$search}%")
                            ->orWhere('name', 'LIKE',"%{$search}%")
                            ->orWhere('callsign', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = User::where('id', '>', 1)
                            ->where('id','LIKE',"%{$search}%")
                            ->orWhere('name', 'LIKE',"%{$search}%")
                            ->orWhere('callsign', 'LIKE',"%{$search}%")
                            ->count();
        }

        $data = array();
        $url = url('');


        if(!empty($members))
        {
            foreach ($members as $key => $member)
            {
                $nestedData['member'] = '<a href="#" class="detail" data-id="'.$member->id.'" data-toggle="modal" data-target="#detailModal">'.$member->name.'  <br> No. Hp: '.$member->no_hp.' <br> Callsign: '.$member->callsign ?? '-'.'</a>';

                if (!is_null($member->class_premium)) {
                    $nestedData['member'] .= '<div class="font-weight-bold">Class Premium : '.ucfirst($member->class_premium).'</div>';
                }

                $nestedData['keterangan'] = 'Keterangan';
                // award class option
                $nestedData['award_class'] = '<select class="form-control award-class-'.$member->id.'">
                                                    <option value="gold class">Gold Class</option>
                                                    <option value="silver class">Silver Class</option>
                                                    <option value="bronze class">Bronze Class</option>
                                                    <option value="early class">Early Class</option>
                                            </select>';

                $nestedData['status_kirim'] = $member->status_kirim_billing_gold == 1 ? 'Gold: <span class="text-success">Sudah</span> <br>' : 'Gold: <span class="text-danger">Belum</span><br>';
                $nestedData['status_kirim'] .= $member->status_kirim_billing_silver == 1 ? 'Silver: <span class="text-success">Sudah</span><br>' : 'Silver: <span class="text-danger">Belum</span><br>';
                $nestedData['status_kirim'] .= $member->status_kirim_billing_bronze == 1 ? 'Bronze: <span class="text-success">Sudah</span><br>' : 'Bronze: <span class="text-danger">Belum</span><br>';
                $nestedData['status_kirim'] .= $member->status_kirim_billing_early == 1 ? 'Early: <span class="text-success">Sudah</span>' : 'Early: <span class="text-danger">Belum</span>';

                $nestedData['action'] = '
                <a href="javascript:void(0)" class="badge badge-success p-2" onclick="kirimBilling(`'.$member->id.'`)"  data-toggle="modal" data-target="#modalKirimTagihan">Kirim Tagihan</a>';

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

    public function kirimTagihan(Request $request)
    {
        $user = User::find($request->user_id);
        try {

            if(empty($user))  {
                return response()->json([
                    'status_code' => 400,
                    'message' => 'User not found'
                ]);
            }

            $is_kirim = $this->kirimEmail($user);

            if($is_kirim) {
                $status_code = 200;
                $message = 'Sent email success';

                $this->updateAwardClass($request, $user);
            } else {
                $status_code = 500;
                $message = 'Sent email error. Please contact admin';
            }

            return response()->json([
                'status_code' => $status_code,
                'message' => $message
            ]);

        } catch (\Exception $e) {
            if(config('app.debug')) dd($e->getMessage());

            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    private function kirimEmail($user)
    {
        $return = true;
        try {
            $kirim_email = Mail::to($user->email)->send(new KirimTagihan(['user' => $user]));
        } catch (\Exception $e) {
            if(config('app.debug')) dd($e->getMessage());
            $return = false;
        }

        return $return;
    }

    private function updateAwardClass($request, $user)
    {
        if($request->award_class == 'gold class') {
            $user->status_kirim_billing_gold = 1;
        } else if($request->award_class == 'silver class'){
            $user->status_kirim_billing_silver = 1;
        } else if($request->award_class == 'bronze class'){
            $user->status_kirim_billing_bronze = 1;
        } else if($request->award_class == 'early class'){
            $user->status_kirim_billing_early = 1;
        }

        $user->save();
    }
}
