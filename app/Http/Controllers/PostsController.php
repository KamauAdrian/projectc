<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth')->except('index');

    }

    public function index()
    {
        $posts = Post::Latest()->get();
        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

//        dd(request()->all());
        //validate the request
        $this->validate(request(),[
            'title'=>'required',
            'body'=>'required'
        ]);



        //create a new post
        $post = new Post();
        $post->user_id  = auth()->user()->id;
        $post->title  = request('title');
        $post->body  = request('body');
        if($request->has('img')){
            $file = $request->file('img');

            $name = $file->getClientOriginalName();
            $file->move('images', $name);
            $input['path']=$name;
            $post->path = $name;
        }else{
            $name = 'avatar.png';
            $post->path = $name;
        }

//        if($post->has('img')){
//            $file = $request->file('img');
//            $name = $file->getClientOriginalName();
//            $file->move('images',$name);
//            $input['path']= $name;
//            $post->path = $name;
//        }else{
//            $name = 'avatar.png';
//            $post->path = $name;
//        }


        //save the new post

        $post->save();

        //redirect to the main page
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
