<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class UserController extends Controller
{
    public function SeConnecter(Request $request)
    {
        $user = DB::table('users')->where('name', $request->name)->first();
        if ($user == null) {
            session()->flash('error', "invali user or password");
            toast(session('error'), 'error');
            return redirect(route('login'));
        } else if (!Hash::check($request->password, $user->password)) {
            session()->flash('error', "invalid user or password");
            toast(session('error'), 'error');
            return redirect(route('login'));
        } else {
            $request->session()->put('name', $user->name);
            $request->session()->put('id', $user->id);
            session()->flash('success', "Welcome ");
            toast(session('success'), 'success');
            return redirect(route('client.index'));
        }
    }
    public function logout(Request $request)
    {
        $request->session()->forget('id');
        $request->session()->forget('name');
        return redirect(route('login'));
    }
    public function getAllUser()
    {
        $user = User::all();
        return view('User.index')->with('users', $user);
    }
    public function store(UserRequest $request)
    {
        $user = User::Create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if ($user) {
            session()->flash('success', "User created successfly ");
            toast(session('success'), 'success');
        } else {
            session()->flash('success', "User no  Created ");
            toast(session('success'), 'success');
        }
        return redirect(route('user.index'));
    }
    public function deleteUser($id)
    {
        $user = User::find($id);
        $result = $user->delete();
        if ($result) {
            session()->flash('success', "User deleted successfly ");
            toast(session('success'), 'success');
        } else {
            session()->flash('error', "User no deleted ");
            toast(session('error'), 'error');
        }
        return redirect(route('user.index'));
    }
}
