<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\GlobalModel;
use App\Http\Controllers\GlobalController;
use App\Models\User;

class UserController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        $segments = $request->segments();
        if($segments[0]=='user') {
            $data['active'] = 5; 
            $data['utype'] = 1; 
        } else if($segments[0]=='admin') {
            $data['active'] = 6; 
            $data['utype'] = 2; 
        } else {
            abort(404);
        }
        return view('user.home', $data);
    }

    public function list($utype=0) {
        return User::where('type', $utype)->where('status','<>', 2)->get();
    }

    public function create(Request $request) {
        $segments = $request->segments();
        if($segments[0]=='user') {
            $data['active'] = 5; 
            $data['utype'] = 1; 
        } else if($segments[0]=='admin') {
            $data['active'] = 6; 
            $data['utype'] = 2; 
        } else {
            abort(404);
        }
        return view('user.create', $data);
    }
 
    public function store(Request $request) {
        $response = 'error';

        $data = $request->data;
        $is_exist = User::where('id_no',$data['id_no'])->where('type',$data['type'])->exists();
        if ($is_exist) {
            $response = 'exist';
        } else  {
            $data['username'] = $data['id_no']; 
            $data['password'] = Hash::make($data['id_no']);
            $data['status'] = 1; 
            if($data['type']==2) {
                $data['password_update'] = 1;
            }
            $result = User::create($data);
            if ($result) {
                $response = 'success';
            }
        }
        return $response;
    }

    public function edit(Request $request) { 
        $segments = $request->segments();
        if($segments[0]=='user') {
            $data['active'] = 5; 
            $data['utype'] = 1; 
        } else if($segments[0]=='admin') {
            $data['active'] = 6; 
            $data['utype'] = 2; 
        } else {
            abort(404);
        }
        
        $data['datauser'] = User::where('id', $request->id)->first();
        if ($data['datauser'] !== null) {
            return view('user.edit', $data);
        } else {
            abort(404);
        }
    }
 
    public function update(Request $request) {
        $response = 'error'; 

        $data = $request->data; 
        $result = User::where(['id'=>$data['id']])->update($data);
        if ($result) {
            $response = 'success';
        }
        return $response;
    }

    public function security(Request $request) { 
        $segments = $request->segments();
        if($segments[0]=='user') {
            $data['active'] = 5; 
            $data['utype'] = 1; 
        } else if($segments[0]=='admin') {
            $data['active'] = 6; 
            $data['utype'] = 2; 
        } else {
            abort(404);
        }
        
        $data['datauser'] = User::where('id', $request->id)->first();
        if ($data['datauser'] !== null) {
            return view('user.security', $data);
        } else {
            abort(404);
        }
    }

    public function profile($id) {
        $data['active'] = 0; 
        $data['datauser'] = User::where('id', $id)->first();
        if ($data['datauser']) {
            return view('user.profile', $data);
        } else {
            abort(404);
        }
    } 
 
    public function destroy(Request $request) {
        $response = 'error';

        $data = $request->data;
        $result = User::where(['id'=>$data['id']])->update($data);
        if($result){
            $response = "success";
        }
        return $response;
    }
    
    public function account(Request $request)
    {    
        $response = 'error';
        
        $data = $request->data;
        $data['password'] = Hash::make($data['password']); 
        $result = User::where(['id'=>$data['id']])->update($data);
        if($result){
            $response = "success";
        }
    }

}
