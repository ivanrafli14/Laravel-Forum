<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function create($user_id){
        $categories = category::all();
        return view('addquestion', ['id' => $user_id, 'categories' => $categories]);
    }

    public function store(Request $request, $user_id){
        //dd($request);

        $validate = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|file ',
            'category_id' => 'required',
        ]);

        

        if($request->file('image')) {
            $validate['image'] =$request->file('image')->storeAs(
                'images', $request->file('image')->getClientOriginalName()
            );
            
        }

        post::create([
    		'title' => $validate['title'],
    		'description' => $validate['description'],
            'category_id' => $validate['category_id'],
            'image' => $validate['image'],
            'user_id' => $user_id,
    	]);

        return  redirect('/dashboard')->with('success', 'created');

        
    }

    public function edit($post_id){
        $filter = post::find($post_id);
        $categories = category::all();
        //dd($filter);
        return view('edit', compact('filter', 'categories'));
    }

    public function update(Request $request, $post_id){
        $validate = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|file ',
            'category_id' => 'required',
        ]);

        //dd($request);
        if($request->file('image')) {
            $validate['image'] =$request->file('image')->storeAs(
                'images', $request->file('image')->getClientOriginalName()
            );
            
        }
        $data = post::find($post_id);

        $data->update([
    		'title' => $validate['title'],
    		'description' => $validate['description'],
            'category_id' => $validate['category_id'],
            'image' => $validate['image'] ?? $data['image'],
    	]);

         return  redirect('/dashboard');


    }

    public function destroy($post_id){
        post::find($post_id)->delete();

        return redirect('/dashboard');


    }
}
