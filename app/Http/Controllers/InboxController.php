<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Inbox;
use Session;
use Auth;

use App\Http\Requests;

class InboxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Inbox::join('users', 'inboxes.sender_id', '=', 'users.id')
            ->where('inboxes.recepient_email', '=', Auth::user()->email)
            ->select('inboxes.*', 'users.email' )
            ->get();

        return view('inbox.index')->withMessages($messages);
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
       
        $inbox = new Inbox;

        $inbox->sender_id = $request->sender_id;
        $inbox->recepient_email = $request->recepient_email;
        $inbox->subject = $request->subject;
        $inbox->message = $request->message;
        
         if ($request->reply) {
           $inbox->reply = $request->reply;
        }
        $inbox->save();

        Session::flash('success', 'Message Sent');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Inbox::join('users', 'inboxes.sender_id', '=', 'users.id')
            ->where('inboxes.id', '=', $id)
            ->select('inboxes.*', 'users.email' )
            ->first();

        $messages = Inbox::where('reply', '=', 1)->where('sender_id', '=', $message->id)->get();


        return view('inbox.show')->withMessage($message)->withMessages($messages);
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
