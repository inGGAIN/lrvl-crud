<?php

namespace App\Http\Controllers;

use Carbon\Exceptions\InvalidDateException;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;

class UserController extends Controller
{

    function loginForm()
    {
        //TITLE
        $data['title'] = 'Login';
        //Setelah mengisikan semua Form dengan benar maka akan di arahkan ke 'user.login'(user/login.blade.php)
        return view('user.login', $data);
    }

    function loginAction(Request $request)
    {
        //Jika 'username' dan 'password' benar maka akan di arahkan ke 'home'(page/home.blade.php)
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('home');
        } else //Jika salah satu atau semua salah, atau tidak di isikan maka akan muncul notif eror seperti dibawah
        {
            return back()->withErrors(['Wrong Username and Password Combination']);
        }
    }

    function logOut(Request $request)
    {
        //Jika Logout di klik, maka 'user' akan keluar, dan halaman mengarah ke 'home'
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('home');
    }
    function passForm()
    {
        $data['title']  =   'Password';
        return view('user.password', $data);
    }

    function passAction(Request $request)
    {
        $request->validate([
            'OldPassword'   =>  'required',
            'NewPassword'   =>  'required',
            'Confirmed'     =>  'required|same:NewPassword',
        ]);

        if (Hash::check($request->OldPassword, Auth::user()->password)) {
            $user   =   User::find(Auth::id());
            $user->password = Hash::make($request->NewPassword);
            $user->save();
            return redirect()->route('password')->with('msg', 'Password has Changed');
        } else {
            return back()->withErrors(['Latest Password is Wrong, try Again!']);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::where('name', 'like', '%' . $request->get('q') . '%')
            ->paginate(15)->withQueryString();
        $data =
            [
                'title' =>  'User',
                'users' =>  $users,
                'q'     =>  $request->get('q'),
            ];

        return view('user.index', $data);
        if (count($data)) {
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title']  = 'Add User';
        return view('user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(([
            'name'  =>  'required',
            'username'  =>   'required|unique:tb_user',
            'email'     =>   'required|unique:tb_user',
            'password'  =>  'required',
        ]));

        $user = new User([
            'name'  =>  $request->name,
            'username'  =>  $request->username,
            'email'     =>  $request->email,
            'password'  =>  Hash::make($request->password),
        ]);
        $user->save();

        return redirect()->route('user.index')->with('msg', 'User Added');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return redirect()->route('user.index')->with('msg', 'User Added');
    }

    /**
     * Show the form for editing the specified resource.
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $data['title']  =   'Edit Profile';
        $data['user']   =   $user;

        return view('user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  =>  'required',
        ]);

        $user->name = $request->name;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect()->route('user.index')->with('msg', 'Data is Saved');
    }

    /**
     * Remove the specified resource from storage.

     * @return \Illuminate\Http\Response
     */
    public function destroy(User $id)
    {
        $id->delete();
        return redirect()->back();
    }
}
