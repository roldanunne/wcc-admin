<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\User; 
use App\Models\Module; 

class DashboardController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    // ************************************************************
    // *  Dashboard Data Page
    // ************************************************************/
    public function index() {
        $data['active'] = '1';
        $data['passed_total'] = 12;
        $data['quiz_total'] = 22;
        $data['student_total'] = count(User::where('type', 1)->where('status','<>', 2)->get());
        $data['module_total'] = count(Module::where('status','<>', 2)->get());
        return view('dashboard', $data);
    }
    

}
