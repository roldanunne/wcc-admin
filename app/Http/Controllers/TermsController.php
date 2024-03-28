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
use App\Models\Terms;
use App\Models\Lesson;

class TermsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $data['active'] = 8;
        $data['dataterms'] = Terms::where('id', 1)->first();
        if ($data['dataterms']) {
            return view('terms.show', $data);
        } else {
            abort(404);
        }
    } 
  
    public function edit() {
        $data['active'] = 8;
        $data['dataterms'] = Terms::where('id', 1)->first();
        if ($data['dataterms'] !== null) {
            return view('terms.edit', $data);
        } else {
            abort(404);
        }
    }
 
    public function update(Request $req) {
        $response = 'error'; 

        $data = $req->data; 
        $result = Terms::where('id', 1)->update($data);
        if ($result) {
            $response = 'success';
        }
        return $response;
    }
 

}
