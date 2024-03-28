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

class LessonController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $data['active'] = 2;
        return view('lesson.home', $data);
    }

    public function list() {
        return Lesson::where('status','<>', 2)->get();
    }

    public function create($id) {
        
        $data['active'] = 2;
        $data['datamodule'] = Module::where('id', $id)->first();
        return view('lesson.create', $data);
    }
 
    public function store(Request $req) {
        $response = 'error';
        $now = date('Y-m-d H:i:s');

        $data = $req->data;
        $result = Lesson::create($data);
        if ($result) {
            $response = 'success';
        }
        return $response;
    }

    public function edit($id) {
        $data['active'] = 2;
        $data['datalesson'] = Lesson::where('id', $id)->first();
        if ($data['datalesson']) {
            $data['datamodule'] = Module::where('id', $data['datalesson']->module_id)->first();
            return view('lesson.edit', $data);
        } else {
            abort(404);
        }
    }
 
    public function update(Request $req) {
        $response = 'error'; 

        $data = $req->data; 
        $result = Lesson::where(['id'=>$data['id']])->update($data);
        if ($result) {
            $response = 'success';
        }
        return $response;
    }

    public function show($id) {
        $data['active'] = 2;
        $data['datalesson'] = Lesson::where('id', $id)->first();
        if ($data['datalesson']) {
            $data['datamodule'] = Module::where('id', $data['datalesson']->module_id)->first();
            return view('lesson.show', $data);
        } else {
            abort(404);
        }
    } 
 
    public function destroy(Request $req) {
        $response = 'error';
        $now = date('Y-m-d H:i:s');

        $data = $req->data;
        $result = Lesson::where(['id'=>$data['id']])->update($data);
        if($result){
            $response = "success";
        }
        return $response;
    }

}
