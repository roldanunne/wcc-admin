<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\GlobalController;
use App\Models\GlobalModel;
use App\Models\Module;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\QuizQuestion; 

class QuizController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $data['active'] = 4;
        $data['modulelist'] = Module::where('status','<>', 2)->get();
        return view('quiz.home', $data);
    }

    public function list() {
        return Quiz::where('status','<>',2)->get();
    }

    public function create() {
        $data['active'] = 4;
        $data['modulelist'] = Module::where('status','<>', 2)->get();
        return view('quiz.create', $data);
    }
 
    public function store(Request $req) {
        $response = 'error';

        $data = $req->data;

        $quiz_data = $data['quiz_data'];
        $result = Quiz::create($quiz_data);        
        if ($result) {
            $quiz_id = GlobalModel::getLastInsertId();
            $quiz_question = $data['question_obj'];
            $i=0;
            foreach($quiz_question as $row) {
                $question_data = [];
                $question_data['quiz_id']       = $quiz_id;
                $question_data['question']      = $row['question'];
                $question_data['answer_a']      = $row['answer_a'];
                $question_data['answer_b']      = $row['answer_b'];
                $question_data['answer_c']      = $row['answer_c'];
                $question_data['answer_d']      = $row['answer_d'];
                $question_data['answer']        = $row['answer'];
                $question_data['explanation']   = (isset($row['explanation']))?$row['explanation']:'';
                $result_question = QuizQuestion::create($question_data); 
            }
            $response = 'success';
        }
        return $response;
    }

    public function edit($id) {
        $data['active'] = 4;
        $data['quiz_data'] = Quiz::where('id', $id)->first();
        if ($data['quiz_data'] !== null) { 
            $data['module_data'] = Module::where('id',$data['quiz_data']->module_id)->first();
            $data['question_obj']  = QuizQuestion::where('quiz_id', $id)->get();
        } else {
            abort(404);
        }
        return view('quiz.edit', $data);
    }
 
    public function update(Request $req) {
        $response = 'error'; 

        $data = $req->data; 
        $task = $data['task'];
        unset($data['task']);
        
        if($task=='update_quiz') { 
            $result = Quiz::where(['id'=>$data['id']])->update($data);
            if ($result) {
                $response = 'success';
            }
        } else if($task=='store_question') { 
            $result = QuizQuestion::create($data); 
            if ($result) {
                $response = 'success';
                $total_question = QuizQuestion::where('quiz_id', $data['quiz_id'])->get();
                Quiz::where(['id'=>$data['quiz_id']])->update(['total_question' => count($total_question)]);
            }
        } else if($task=='update_question') { 
            $result = QuizQuestion::where(['id'=>$data['id']])->update($data);
            if ($result) {
                $response = 'success';
            }
        } else if($task=='destroy_question') { 
            $result = QuizQuestion::where(['id'=>$data['id']])->delete();
            if ($result) {
                $response = 'success';
            }
        }
        return $response;
    }

    public function show($id) {
        $data['active'] = 4;
        $data['quiz_data'] = Quiz::where('id', $id)->first();
        if ($data['quiz_data'] !== null) { 
            $data['module_data'] = Module::where('id',$data['quiz_data']->module_id)->first();
            $data['question_obj']  = QuizQuestion::where('quiz_id', $id)->get();
        } else {
            abort(404);
        }
        return view('quiz.show', $data);
    } 
 
    public function destroy(Request $req) {
        $response = 'error';
        $now = date('Y-m-d H:i:s');

        $data = $req->data;
        $result = Quiz::where(['id'=>$data['id']])->update($data);
        if($result){
            $response = "success";
        }
        return $response;
    }

}
