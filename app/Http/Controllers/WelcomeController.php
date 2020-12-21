<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Award;
use App\User;
use App\Banner;
use App\UserAward;
use Illuminate\Support\Facades\DB;
use DataTables;

class WelcomeController extends Controller
{
    public function index()
    {
        $data['awards'] = Award::paginate(6);
        $data['banners'] = Banner::all();

        return view('welcome.awards', $data);
    }

    public function jsonMembers(Request $request)
    {

        $columns = [
            'name', 'category', 'callsign', 'register'            
        ];
  
        $totalData = User::count();
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $members = User::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }
        else {
            $search = $request->input('search.value'); 

            $members =  User::where('id','LIKE',"%{$search}%")
                            ->orWhere('name', 'LIKE',"%{$search}%")
                            ->orWhere('callsign', 'LIKE',"%{$search}%")
                            ->orWhere('category', 'LIKE',"%{$search}%")
                            ->orWhere('register', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = User::where('id','LIKE',"%{$search}%")
                             ->orWhere('name', 'LIKE',"%{$search}%")
                             ->orWhere('callsign', 'LIKE',"%{$search}%")
                             ->orWhere('category', 'LIKE',"%{$search}%")
                            ->orWhere('register', 'LIKE',"%{$search}%")
                             ->count();
        }

        $data = array();
        if(!empty($members))
        {
            foreach ($members as $key => $member)
            {
                // $show =  route('posts.show',$post->id);
                // $edit =  route('posts.edit',$post->id);
                $nestedData['#'] = ++$key;
                if ($member->category == 'premium') {
                    $nestedData['name'] = '<a href="#" class="detail" data-memberid="YB6_DXCom#'.substr($member->member_id, -3).'" data-callsign='.$member->callsign.'>'.$member->name.'</a>';
                } else if ($member->category == 'free') {
                    $nestedData['name'] = '<a href="#" class="detail" data-memberid="BSC#'.substr($member->member_id, -3).'" data-callsign='.$member->callsign.'>'.$member->name.'</a>';
                }

                $nestedData['category'] = ucfirst($member->category);
                $nestedData['callsign'] = $member->callsign;
                $nestedData['register'] = ($member->register == null) ? '-' : $member->register;
                $nestedData['expired'] = ($member->register == null) ? '-' : date('Y-m-d', strtotime('+365 day', strtotime($member->register)));
                $data[] = $nestedData;

            }
        }
          
        $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
            
        return response()->json($json_data);
    }

    public function members()
    {

        $data['banners'] = Banner::all();
        
        return view('welcome.members', $data);
    }

    public function jsonDetailMember(Request $request)
    {
        $member = User::where('callsign', $request->get('callsign'))->with('userAwards')->get();

        $data['member'] = [
            'name' => $member[0]->name,
            'callsign' => $member[0]->callsign,
            'alamat' => $member[0]->alamat,
            'foto' => $member[0]->foto,
            'category' => ucfirst($member[0]->category),
            'class_premium' => strtoupper($member[0]->class_premium)
        ];

        $data['records'] = [];

        foreach ($member[0]->userAwards as $award) {
            $data['records'][] = [
                'award_name' => $award['nama'],
                'award_category' => $award['category'],
                'award_url' => $award['url_award']
            ];
        }

        $data['total_records'] = count($data['records']);


        return response()->json($data);
    }
}
