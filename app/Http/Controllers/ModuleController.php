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
use App\Models\Module;
use App\Models\Lesson;

class ModuleController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $data['active'] = 2;
        return view('module.home', $data);
    }

    public function list() {
        return Module::where('status','<>', 2)->get();
    }

    public function create() {
        $data['active'] = 2;
        return view('module.create', $data);
    }
 
    public function store(Request $req) {
        $response = 'error';
        $now = date('Y-m-d H:i:s');

        $data = $req->data;
        $result = Module::create($data);
        if ($result) {
            $response = 'success';
        }
        return $response;
    }

    public function edit($id) {
        $data['active'] = 2;
        $data['datamodule'] = Module::where('id', $id)->first();
        if ($data['datamodule'] !== null) {
            return view('module.edit', $data);
        } else {
            abort(404);
        }
    }
 
    public function update(Request $req) {
        $response = 'error'; 

        $data = $req->data; 
        $result = Module::where(['id'=>$data['id']])->update($data);
        if ($result) {
            $response = 'success';
        }
        return $response;
    }

    public function show($id) {
        $data['active'] = 2;
        $data['datamodule'] = Module::where('id', $id)->where('status','<>', 2)->first();
        $data['lessonlist'] = Lesson::where('module_id', $id)->where('status','<>', 2)->get();
        if ($data['datamodule']) {
            return view('module.show', $data);
        } else {
            abort(404);
        }
    } 
 
    public function destroy(Request $req) {
        $response = 'error';
        $now = date('Y-m-d H:i:s');

        $data = $req->data;
        $result = Module::where(['id'=>$data['id']])->update($data);
        if($result){
            $response = "success";
        }
        return $response;
    }

}
