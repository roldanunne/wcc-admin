<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;  

use Hash;
use Session;
use Auth;

use App\Models\User;

class AuthController extends Controller
{
      
    public function authenticate(Request $request)
    {
        $response = '_error';  
        
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $data = User::where('id', $user->id)->first(); 
            $response = json_encode($data);
        } 
        return $response;
    }

    public function user_data(Request $request)
    {
        $response = '_error';  

        $user = User::where('id', $request->id)->first(); 
        if ($user) {  
            $response = json_encode($user);
        } 
        return $response;
    }

    public function update_password(Request $request)
    {
        $response = '_error';  
        
        // $data = $request->password;
        $data['password'] = Hash::make($request->password);
        $data['password_update'] = 1;
        $result = User::where(['id'=>$request->id])->update($data);
        if ($result) {  
            $user = User::where('id', $request->id)->first(); 
            $response = json_encode($user);
        } 
        return $response;
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