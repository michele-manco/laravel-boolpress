<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;


class PostController extends Controller
{
  // public function __construct()
  // {
  //     $this->middleware('auth');
  // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dati = $request->all();
        $post = new Post();
        $post ->fill($dati);
        $slug_originale = Str::slug($dati['title']);
        $slug = $slug_originale;
        //verifico che nel db nn esista slug=!
        $post_stesso_slug = Post::where('slug', $slug)->first();
        $slug_trovati = 1;
        while(!empty($post_stesso_slug)) {
          $slug = $slug_originale .'-'. $slug_trovati;
          $post_stesso_slug = Post::where('slug', $slug)->first();
          $slug_trovati++;
        }
        $post->slug = $slug;
        $post ->save();
        return redirect()->route('admin.posts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $post = Post::find($id);
        return view('admin.posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post= Post::find($id);
        return view('admin.posts.edit' , ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $dati = $request->all();
        $post->update($dati);
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
      $post = Post::find($id);
      $post->delete();
      return redirect()->route('admin.posts.index');


    }
}
