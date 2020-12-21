<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Award;
use App\UserAward;
use App\RulesAward;
use App\UserAdif;

class AwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->active == 0) {
            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect('login')->with('error', 'Sorry your account is inactive or your membership is no longer valid. please <a href="https://yb6-dxc.net/contact-us/">contact us</a>');    
        }

        $awards = Award::with('userAwards')->get()->toArray();

        return view('award', compact('awards'));
    }

    public function checkAwardToClaim(Request $request)
    {
        if ((int)$request->id <= 0) {
            return false;
        }

        $userAdif = UserAdif::where('user_id', Auth::user()->id)->first();

        if (empty($userAdif)) {
            return response()->json(['message' => 'No file upload adif, please upload file .adi on menu Upload File', 'status' => 400], 400);
        }

        // $rulesAward = RuleAward::where('award_id', $request->id)->first();
        $rulesAward = RulesAward::where('award_id', $request->id)->get()->toArray();

        if (empty($rulesAward)) {
            return response()->json(['message' => 'No Rule, Please Contact Admin', 'status' => 400], 400);
        }

        $data = $this->checkRulesAward($userAdif, $rulesAward);

        if ($data['rule'] == '<div class="text-success">FULFILLED</div>') {
            $userAward = UserAward::create([
                'user_id' => Auth::user()->id,
                'award_id' => $request->id,
                'link_googledrive' => 'https://www.google.com'
            ]);

            $userAward->save();

            $data['user_awards'] = $userAward;
        }

        return $data;
    }

    private function checkRulesAward($userAdif, $rulesAward)
    {
        $return = [];

        foreach ($rulesAward as $k => $rule) {
            $data['call'] = 0;
            $data['band'] = 0;
            $data['mode'] = 0;
           
            foreach (json_decode($userAdif->data_adif) as $record) {

                $call = json_decode($rule['call']);
                $band = json_decode($rule['band']);
                $mode = json_decode($rule['mode']);

                if (preg_match('/'. substr($call[0], 0, 3) .'/', $record[0])) {
                    if ($call[2] != "" && $call[3] != "") {
                        if (($call[2] <= $record[3]) && ($call[3] >= $record[3])) {
                            $data['call']++;
                        }
                    } else {
                        $data['call']++;
                    }
                }

                if (preg_match('/'. $band[0] .'/', $record[1])) {
                    if ($band[2] != "" && $band[3] != "") {
                        if (($band[2] <= $record[3]) && ($band[3] >= $record[3])) {
                            $data['band']++;
                        }
                    } else {
                        $data['band']++;
                    }
                }

                if (preg_match('/'. $mode[0] .'/', $record[2])) {
                    if ($mode[2] != "" && $mode[3] != "") {
                        if (($mode[2] <= $record[3]) && ($mode[3] >= $record[3])) {
                            $data['mode']++;
                        }
                    } else {
                        $data['mode']++;
                    }
                }
            }


            if ($call[0] != null) {
                $return['call'][] = ' '. $call[0] . ' matched <b>' . $data['call'] . '</b>';
                if ($data['call'] >= $call[1]) {
                    $return['message'][] = '<span class="text-dark">Call '.$call[0].' fulfilled</span>';
                } else if ($data['call'] <= $call[1]) {
                    $return['message'][] = '<span class="text-danger">Call '.$call[0].' unfulfilled</span>';
                }
            }

            if ($band[0] != null) {
                $return['band'][] = ' '. $band[0] . ' matched <b>' . $data['band'] . '</b>';
                if ($data['band'] >= $band[1]) {
                    $return['message'][] = '<span class="text-dark">Band '.$band[0].' fulfilled</span>';
                } else if ($data['band'] <= $band[1]) {
                    $return['message'][] = '<span class="text-danger">Band '.$band[0].' unfulfilled</span>';
                }
            }

            if ($mode[0] != null) {
                $return['mode'][] = ' '. $mode[0] . ' matched <b>' . $data['mode'] . '</b>';
                if ($data['mode'] >= $mode[1]) {
                    $return['message'][] = '<span class="text-dark">Mode '.$mode[0].' fulfilled</span>';
                } else if ($data['mode'] <= $mode[1]) {
                    $return['message'][] = '<span class="text-danger">Mode '.$mode[0].' unfulfilled</span>';
                }
            }
        }

        $return['rule'] = '<div class="text-success">FULFILLED</div>';
        foreach ($return['message'] as $msg) {
            if (preg_match('/unfulfilled/', $msg)) {
                $return['rule'] = '<div class="text-danger">UNFULFILLED</div>';
            }
        }

        return $return;
    }

}
