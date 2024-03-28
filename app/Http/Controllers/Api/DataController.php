<?php
namespace App\Http\Controllers\Api;
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
use App\Models\Settings;
use App\Models\Terms;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizTaker;
use App\Models\User;

class DataController extends Controller {

    public function terms_data() { 
        $response   = 'error'; 
        $result     = Terms::where('id',1)->first();
        if($result) {
            $response = json_encode($result,JSON_NUMERIC_CHECK);
        } 
        return $response;
    }

    public function settings_data() { 
        $response   = 'error'; 
        $result     = Settings::where('id',1)->first();
        if($result) {
            $response = json_encode($result,JSON_NUMERIC_CHECK);
        } 
        return $response;
    }

    public function module_list() { 
        $response   = 'error';
        $list       = array();
        $result     = Module::where('status','<>', 2)->get();
        if ($result) {
            foreach($result as $row) {
                $row->lesson  = Lesson::where('status','<>', 2)->where('module_id',$row->id)->get();
                array_push($list, $row);
            }
        }
        return json_encode($list,JSON_NUMERIC_CHECK);
    }

    public function quiz_list() { 
        $response   = 'error';
        $list       = array();
        $result     = Quiz::where('status','<>',2)->get();
        if ($result) {
            foreach($result as $row) {
                $temp = Module::where('id',$row->module_id)->first();
                $row->module_title = $temp->title;
                $row->question_list  = QuizQuestion::where('quiz_id',$row->id)->get();
                array_push($list, $row);
            }
        }
        return json_encode($list,JSON_NUMERIC_CHECK);
    }


    public function take_quiz_list(Request $request) {
        $response   = 'error';
        $list       = array();
        $result     = QuizTaker::where('user_id', $request->id)->get(); 
        if ($result) {
            foreach($result as $row) {
                $temp = Quiz::where('id',$row->quiz_id)->first();
                $row->title = $temp->title;
                array_push($list, $row);
            } 
        } 
        return json_encode($list,JSON_NUMERIC_CHECK);
    }

    public function take_quiz(Request $request) {
        $response   = 'error'; 
        $data['user_id']    = $request->user_id;
        $data['quiz_id']    = $request->quiz_id;
        $data['question']   = $request->question;
        $data['score']      = $request->score;
        $data['result']     = $request->result;
        $result = QuizTaker::create($data);
        if ($result) {
            $quiz = QuizTaker::get(); 
            $response = json_encode($quiz,JSON_NUMERIC_CHECK);
        } 
        return $response;
    }

}
