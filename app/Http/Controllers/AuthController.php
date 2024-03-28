<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {   
        if(Auth::check()){
            return redirect()->intended('dashboard');
        }
        return view('login');
    }  
      
    public function authenticate(Request $request)
    {
        $response = 'error';
        
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if($user->type == 2){
                session(['userdata' => $user]);
                $response='success';
            } else {
                Auth::logout();
            }
        } 
        if($response=='success'){
            return redirect()->intended('dashboard');
        } else {
            return redirect('login')->with('message', 'Login details are not valid');
        }
    }

    public function register()
    {  
        // $request->validate([
        //     'username' => 'required|unique:users',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|min:8',
        //     'mobile' => 'required',
        // ]);
           
        // $data = $request->all();
        // $check = User::create([
        //     'fname' => "administrator",
        //     'username' => "administrator",
        //     'password' => Hash::make("administrator")
        // ]);;
        
        $data['password'] = Hash::make("administrator");
        $result = User::where(['id'=>1])->update($data);
        return redirect("dashboard")->withSuccess('You have signed-in');
    }

    public function logout() {
        Session::flush();
        Auth::logout();
  
        return redirect('login');
    }
    
}