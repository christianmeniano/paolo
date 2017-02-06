<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Comment;
use App\Post;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Admin;
use Session;


class AdminRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

       public function __construct()
    {
        
    }


    public function index()
    {
        if (!session()->has('id')) {
            return redirect()->route('login');
        }
         $adminid = session('id');

         $admin = Admin::where('id' , '=' , $adminid)->first();
         session(['email' => $admin->email]);
         $post = Post::join('users', 'posts.blogger_id', '=', 'users.id')
            ->select('users.name', 'posts.*')
            ->get();
         $user = User::all();
          $comment = Comment::join('users', 'comments.u_id', '=', 'users.id')
            ->select('users.name', 'comments.*')
            ->get();

       
        return view('admin.index')->withAdmin($admin)->withUsers($user)->withComments($comment)->withPosts($post);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.register');
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
                'name' => 'required|max:255',
                'email' => 'required',
                'password' => 'required',
            ));

        $admin = new Admin;

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = $request->password;
        $admin->save();

        session(['id' => $admin->id]);
        return redirect()->route('admin.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $adminid = session('id');
         $admin = Admin::where('id' , '=' , $adminid)->first();

        $post = Post::find($id);
         $comment = Comment::join('users', 'comments.u_id', '=', 'users.id')
            ->select('users.name', 'comments.*')
            ->where('blog_id', '=' , $post->id)
            ->where('status', '=' , 0)
            ->get();
        return view('admin.show')->withPost($post)->withComments($comment)->withAdmin($admin);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $adminid = session('id');
        $admin = Admin::where('id' , '=' , $adminid)->first();

        $post = Post::find($id);
        
        return view('admin.edit')->withPost($post)->withAdmin($admin);
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
        

        $post = Post::find($id);

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->body = $request->body;

        $post->save();

        Session::flash('success' , 'This post was successfully saved.');

        return redirect()->route('admin.show', $post->id);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    
        $post = Post::where('blogger_id', $id);
        $user = User::find($id);
        
        $post->delete();

        $user->delete();

        Session::flash('success', 'The post was successfully deleted');

        return redirect()->route('admin.index');

    }
}





