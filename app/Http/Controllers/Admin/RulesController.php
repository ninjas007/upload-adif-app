<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Award;
use App\RulesAward;

class RulesController extends Controller
{
    public function index()
    {
    	$rules = RulesAward::get()->toArray();
    	$data['rules'] = [];
    	foreach ($rules as $key => $rule) {
    		$call = json_decode($rule['call']);
    		$mode = json_decode($rule['mode']);
    		$band = json_decode($rule['band']);
    		$msg = '';
    		if ($call[0] != '') {
    			$msg .= 'Call '.$call[0].'<br>';
    		}
    		if ($call[1] != '') {
    			$msg .= ' minimal call '.$call[1].'<br>';
    		}
    		if ($call[2] != '') {
    			$msg .= ' call tanggal '.$call[2].'<br>';
    		}
    		if ($call[3] != '') {
    			$msg .= ' sampai tanggal '.$call[3].'<br>';
    		}

    		$msg .= '<hr>';

    		if ($band[0] != '') {
    			$msg .= 'band '.$band[0].'<br>';
    		}
    		if ($band[1] != '') {
    			$msg .= ' minimal band '.$band[1].'<br>';
    		}
    		if ($band[2] != '') {
    			$msg .= ' band tanggal '.$band[2].'<br>';
    		}
    		if ($band[3] != '') {
    			$msg .= ' sampai tanggal '.$band[3].'<br>';
    		}

    		$msg .= '<hr>';

    		if ($mode[0] != '') {
    			$msg .= 'mode '.$mode[0].'<br>';
    		}
    		if ($mode[1] != '') {
    			$msg .= ' minimal mode '.$mode[1].'<br>';
    		}
    		if ($mode[2] != '') {
    			$msg .= ' mode tanggal '.$mode[2].'<br>';
    		}
    		if ($mode[3] != '') {
    			$msg .= ' sampai tanggal '.$mode[3].'<br>';
    		}

			$data['rules'][] = [
				'id' => $rule['id'],
				'rule' => $msg,
				'award' => Award::where('id', $rule['award_id'])->first()->toArray()['nama']
			];    		
    	}

    	return view('admin.rules.index', $data);
    }

    public function create()
    {
    	$data['awards'] = Award::all();

    	return view('admin.rules.create', $data);
    }

    public function store(Request $request)
    {
		foreach ($request->call_value as $key => $call) {
			$call = [
				$request->call_value[$key],
				$request->call_min_data[$key],
				str_replace("-", "", $request->call_date_start[$key]),
				str_replace("-", "", $request->call_date_end[$key]),
			];

			$band = [
				$request->band_value[$key],
				$request->band_min_data[$key],
				str_replace("-", "", $request->band_date_start[$key]),
				str_replace("-", "", $request->band_date_end[$key]),
			];

			$mode = [
				$request->mode_value[$key],
				$request->mode_min_data[$key],
				str_replace("-", "", $request->mode_date_start[$key]),
				str_replace("-", "", $request->mode_date_end[$key]),
			];

			$results[] = DB::table('rules_awards')->insert([
				'call' => json_encode($call),
			    'band' => json_encode($mode),
			    'mode' => json_encode($band),
				'award_id' => $request->award
			]);
		}

		foreach ($results as $key => $result) {
			if ($result == false) {
				DB::table('rules_awards')->where('award_id', $request->award)->delete();

				return redirect('admin/rules')->with('error', 'Gagal menambah rule award ke '.$request->award.'. baris ke ' .++$key.' ');
			}
		}

		return redirect('admin/rules')->with('success', 'Berhasil menambah rule untuk award ke '.$request->award.'');
    }

    public function destroy($id)
    {
    	$rules = RulesAward::findOrFail($id);
    	$rules->delete();

    	return redirect('admin/rules')->with('success', 'Berhasil menghapus rules');
    }

    private function checkvalidateRequest($request)
    {
    	if (empty($request->award)) {
    		echo 'Award tidak boleh kosong';
    		die;
    	}

    	if (empty($request->rules_key)) {
    		echo 'Baris rule tidak boleh kosong';
    		die;
    	}

    	return true;
    }
}
