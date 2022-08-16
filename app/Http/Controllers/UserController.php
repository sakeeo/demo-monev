<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function users()
    {
        $data['title'] = 'Data User';
        $data['users']  = User::all();
        return view('user/index', $data);
    }

    public function register()
    {
        $data['title'] = 'Register';
        return view('user/register', $data);
    }

    public function register_action(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'jabatan' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ]);

        $user = new User([
            'name' => $request->name,
            'jabatan' => $request->jabatan,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->save();
        return redirect()->route('data.user')->with('success', 'Registration success.');
    }


    public function login()
    {
        $data['title'] = 'Login';
        return view('user/login', $data);
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'password' => 'Wrong username or password',
        ]);
    }

    public function password()
    {
        $data['title'] = 'Change Password';
        return view('user/password', $data);
    }

    public function password_action(Request $request)
    {
        $request->validate([
            'old_password' => 'required|current_password',
            'new_password' => 'required|confirmed',
        ]);
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->new_password);
        $user->save();
        $request->session()->regenerate();
        return back()->with('success', 'Password changed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function hapus($id)
    {
        User::where('id',$id)->delete();
        return redirect()->route('data.user')->with('message', 'Success!');
    }

    public function form_edit($id){

        $data['title'] = 'Login';
        $data['old'] = User::find($id);
        return view('user/form-edit', $data);
    }

    public function update_action(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'jabatan' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ]);
        $data = [
            'name'      => $request->name,
            'jabatan'   => $request->jabatan,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ];
        User::where('email',$request->email)->update($data);
        return redirect()->route('data.user')->with('success', 'Registration success.');
    }
    
}
