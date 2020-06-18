<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\UserAward;
use App\Award;
use App\User;
use Validator;
use Auth;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = User::where('role', 1)->paginate(5);

        return view('admin.member.index', compact('members'));
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
    public function store(Request $request, $id)
    {
        $userAward = UserAward::where('user_id', $id);
        $userAward->delete();

        // jika ada inputan yang di set
        if (isset($request->award_id)) {
            $rows = count($request->award_id);

            for ($i = 0; $i < $rows; $i++) {
                // jika form inputan kosong, abaikan
                if (is_null($request->post('link_googledrive')[$i])) {
                   continue;
                }
               
                $data[] = [
                   'award_id' => $request->post('award_id')[$i],
                   'user_id' => $id,
                   'link_googledrive' => $request->post('link_googledrive')[$i]
                ];
            }
            
            UserAward::insert($data);
        }

        return redirect('admin/members');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $data['id'] = $id;
        $data['awards'] = Award::get();
        $data['userAwards'] = UserAward::where('user_id', $id)->get();

        return view('admin.member.update', $data);
    }
}   
