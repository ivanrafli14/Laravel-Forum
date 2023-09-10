<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    public function find($user_id){
        $user = User::find($user_id);

        return view('useredit', compact('user'));
    }

    public function update(Request $request, $user_id){
        $validate = $request->validate([
            'name' => 'required',
            'job' => 'required',
            'address' => 'required',
            'age' => 'required',
            'avatar' => 'image|file ',
            'biodata' => 'required',
        ]);

        //dd($request);

        if($request->file('avatar')) {
            $validate['avatar'] =$request->file('avatar')->storeAs(
                'images', $request->file('avatar')->getClientOriginalName()
            );
            
        }
        $data = user::find($user_id);
        
        

        $data->update([
    		'name' => $validate['name'],
    		'job' => $validate['job'],
            'biodata' => $validate['biodata'],
            'age' => $validate['age'],
            'address' => $validate['address'],
            'avatar' => $validate['avatar'] ?? $data['avatar'],
    	]);

        //dd($data);

         return redirect('/dashboard');

    }

    public function filter($user_id){
        $post = post::where('user_id', '=', $user_id)->get();
        $user = user::find($user_id);
        
        //dd($post[0]->user->name);
        return view('userdetail', compact('post', 'user'));
    }

    public function google(){
        return Socialite::driver('google')->redirect();

    }

    public function handleCallback(){
        $callback =  Socialite::driver('google')->stateless()->user();

        
        $data = [
            'name' => $callback->getName(),
            'email' => $callback->getEmail(),
            'avatar' => 'images/avatar-default.jpg',
            'email_verified_at' => date('Y-m-d H:i:s', time())
        ];

        $user = User::firstOrCreate(['email'=> $data['email']], $data);
        Auth::login($user, true);

        //return $data;

        return redirect('/dashboard');

    }
}
