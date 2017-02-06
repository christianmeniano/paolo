<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Admin;
use App\Post;
use App\User;
use App\Inbox;
use Auth;
use App\Comment;

class AdminInboxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!session()->has('id')) {
            return redirect()->route('login');
        }
         $adminid = session('id');
         $admin = Admin::where('id' , '=' , $adminid)->first();
         $post = Post::join('users', 'posts.blogger_id', '=', 'users.id')
            ->select('users.name', 'posts.*')
            ->get();
         $user = User::all();
       $adminemail =  session('email');

        $messages = Inbox::join('users', 'inboxes.sender_id', '=', 'users.id')
            ->where('inboxes.recepient_email', '=', $adminemail)
            ->select('inboxes.*', 'users.email' )
            ->get();

       
        return view('admin.inbox')->withAdmin($admin)->withUsers($user)->withPosts($post)->withMessages($messages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
          $adminemail =  session('email');
          
        $message = Inbox::join('users', 'inboxes.sender_id', '=', 'users.id')
            ->where('inboxes.id', '=', $id)
            ->select('inboxes.*', 'users.email' )
            ->first();

        $messages = Inbox::where('reply', '=', 1)->where('sender_id', '=', $message->id)->get();

       

        return view('admin.inboxshow')->withMessage($message)->withMessages($messages)->withAdmin($admin);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
