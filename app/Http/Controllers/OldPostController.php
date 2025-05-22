<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(post $post){
        return view('post.show',compact('post'));
    }

    // public function show($id){
    //     $post = Post::find($id);
    //     return view('post.show',compact('post'));
    // }

    public function create(){
        return view('post.create');
    }

    public function store(Request $request){
        Gate::authorize('test');

        $validated = $request->validate([
            'title' => 'required|max:20',
            'body' => 'required|max:400',
        ]);

        $validated['user_id'] = auth()->id();

        $post = Post::create($validated);

        // $post = post::create([
        //     'title' => $request->title,
        //     'body' => $request->body,
        // ]);
        $request->session()->flash('message','保存しました');
        return back();
    }

    public function update(Request $request,post $post){
        $validated = $request->validate([
            'title' => 'required|max:20',
            'body' => 'required|max:400',
        ]);

        $validated['user_id'] = auth()->id();

        $post->update($validated);

        $request->session()->flash('message','更新しました');
        return back();
    }

    public function index(){
        // $posts = Post::all();
        // $posts = post::where('user_id',auth()->id())->get();
        // $posts = post::where('user_id','!=',auth()->id())->get();
        $posts = post::whereDate('created_at','>=','2025-5-13')->get();
        return view('post.index',compact('posts'));
    }

    public function edit(post $post){
        return view('post.edit',compact('post'));
    }

    public function destroy(Request $request,post $post){
        $post->delete();
        $request->session()->flash('message','削除しました');
        return redirect()->route('post.index');
    }
}
