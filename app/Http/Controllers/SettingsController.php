<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\GlobalModel;
use App\Http\Controllers\GlobalController;
use App\Models\Settings;
use App\Models\Lesson;

class SettingsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $data['active'] = 7;
        $data['datasettings'] = Settings::where('id', 1)->first();
        if ($data['datasettings']) {
            return view('settings.show', $data);
        } else {
            abort(404);
        }
    } 
  
    public function edit() {
        $data['active'] = 7;
        $data['datasettings'] = Settings::where('id', 1)->first();
        if ($data['datasettings'] !== null) {
            return view('settings.edit', $data);
        } else {
            abort(404);
        }
    }
 
    public function update(Request $req) {
        $response = 'error'; 

        $data = $req->data; 
        $result = Settings::where('id', 1)->update($data);
        if ($result) {
            $response = 'success';
        }
        return $response;
    }
 

}
