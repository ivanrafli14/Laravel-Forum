<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\comment;
use App\Models\post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function show(){
        $category = category::all();
        $post = post::all();
        $user = User::all();
        return view('timeline', compact('category', 'post', 'user'));
    }

    public function search(Request $request){
        $search = $request->search;
        $category = category::all();
        $user = User::all();

        $post = post::where('title','like',"%".$search ."%") -> orWhere('description','like',"%".$search ."%")
		->get();

        return view('timeline', compact('category','post', 'user'));
    }

    public function category_filter($category_id){
        
        $category = category::all();

        $post = post::where('category_id','=', $category_id) ->get();
        $user = User::all();

        //dd($post);
        
        return view('timeline', compact('category','post', 'user'));
    }

    public function forum($post_id){
        $comment = comment::where('post_id', $post_id)->get();
        $post = post::find($post_id);
        //dd($post);
        return view('detail', compact('comment', 'post'));
    }

    public function create(Request $request, $post_id){

        comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $post_id,
            'comment' => $request['comment']
        ]);

        return redirect('/dashboard/'. $post_id);

    }

    public function update(Request $request, $comment_id){
        $comment = comment::find($comment_id);
        //dd($request);
        $post_id = $comment->post->id;
        $comment->update([
            'user_id' => Auth::user()->id,
            'post_id' => $post_id,
            'comment' => $request['comment']
        ]);

        return redirect('/dashboard/'. $post_id)->with('success', 'Updated');

    }

    public function destroy($comment_id){
        $data = comment::find($comment_id);
        $id = $data->post_id;
        $data->delete();

        return redirect('/dashboard/'. $id);

    }
}
