<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use Session;
use Auth;
use App\Comment;
use App\User;

class PostController extends Controller
{ 

     

    // public function __construct() {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth_id = Auth::user()->id;
        $posts = Post::orderBy('id', 'desc')->where('blogger_id','=',$auth_id)->where('status','=','published')->paginate(10);
        return view('posts.index')->withPosts($posts);
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
        $this->validate($request, array(
                'title' => 'required|max:255',
                'blogger_id' => 'required',
                'body' => 'required',
                'slug' => 'required|alpha_dash|min:5|max:255',
            ));
        $post = new Post;

        $post->category = $request->category;
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->body = $request->body;
        $post->blogger_id = $request->blogger_id;
        $post->tags = $request->tags;

        if ($request->status) {
            $post->status = 'published';
        }else{
            $post->status = 'draft';
        }


        $post->save();

        Session::flash('success', 'The blog post was successfully save!');

        return redirect()->route('posts.show', $post->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
         $comment = Comment::join('users', 'comments.u_id', '=', 'users.id')
            ->select('users.name', 'comments.*')
            ->where('blog_id', '=' , $post->id)
            ->where('status', '=' , 0)
            ->get();
        return view('posts.show')->withPost($post)->withComments($comment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $drafts = Post::where('status', '=', 'draft')->where('id', '=', $id)->get();
        return view('posts.edit')->withPost($post)->withDrafts($drafts);
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
        $post = Post::find($id);
        
        if ($request->slug == $post->slug) {
            $this->validate($request, array(
                'title' => 'required|max:255',
                'body' => 'required'
            ));
        } else {
            $this->validate($request, array(
                'title' => 'required|max:255',
                'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
                'body' => 'required'
            ));
        }
        if(!$request->status){
            $request->status = "draft";
        }

        $post = Post::find($id);

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->body = $request->body;
        $post->status = $request->status;
        $post->tags = $request->tags;

        $post->save();

        Session::flash('success' , 'This post was successfully saved.');

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        $post->delete();

        Session::flash('success', 'The post was successfully deleted');

        return redirect()->route('posts.index');
    }

    public function drafts($id){
        $draft = Post::where('status' , '=' , 'draft')->where('id', '=', $id)->where('blogger_id', '=', Auth::id())->get();

        return view('posts.draft')->withDrafts($draft);
    }

    public function draftsindex(){
         $draft = Post::where('status' , '=' , 'draft')->where('blogger_id', '=', Auth::id())->get();

        return view('posts/draftindex')->withDrafts($draft);
    }
}
