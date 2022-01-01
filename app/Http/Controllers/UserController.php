<?php

namespace App\Http\Controllers;

use App\Models\odel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
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

        if(Hash::check($request->OldPassword, Auth::user()->password))
        {
            $user   =   User::find(Auth::id());
            $user   ->  password = Hash::make($request->NewPassword);
            $user->save();
            return redirect()->route('password')->with('msg','Password has Changed');
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
        $users = User::where('name','like','%' . $request->get('q') . '%')
            ->paginate(15)->withQueryString();
        $data = 
        [
            'title' =>  'User',
            'users' =>  $users,
            'q'     =>  $request->get('q'),
        ];

        return view('user.index', $data);
        if(count($data)) {}
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

        return redirect()->route('user.index')->with('msg','User Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\odel  $odel
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return redirect()->route('user.index')->with('msg','User Added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\odel  $odel
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
     * @param  \App\Models\odel  $odel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  =>  'required',
        ]);

        $user->name = $request->name;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect()->route('user.index')->with('msg','Data is Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\odel  $odel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        $id->delete();
        return redirect()->back();
    }
}
