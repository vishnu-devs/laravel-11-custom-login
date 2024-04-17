<?php 
namespace App\Http\Controllers; 
use Illuminate\Http\Request; 
use Hash; 
use Session; 
use App\Models\User; 
use Illuminate\Support\Facades\Auth; 

class CustomAuthController extends Controller { 
    public function index()     { 
        return view('auth.login');     
    }          

    public function registration()     { 
        return view('auth.register');     
    }
    
    public function dashboard() {
        return view('dashboard');
    }

    public function customRegistration(Request $request)     { 
        $request->validate([ 
            'name' => 'required', 
            'email' => 'required|email|unique:users', 
            'password' => 'required|min:6', 
        ]);     

        $data = $request->all(); 
        $data['password'] = bcrypt($data['password']); 
        User::create($data); 

        return redirect("dashboard");
    }

    public function customLogin(Request $request)     { 
        $request->validate([ 
            'email' => 'required', 
            'password' => 'required', 
        ]);     

        $credentials = $request->only('email', 'password'); 
        if (Auth::attempt($credentials)) { 
            return redirect()->intended('dashboard');         
        }    
        return redirect("login");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
