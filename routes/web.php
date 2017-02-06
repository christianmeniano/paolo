<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
use App\User;
use App\Admin;
use Illuminate\Http\Request;

use App\Http\Requests;

Auth::routes();
Route::get('blog/{slug}', ['as' => 'blog.single', 'uses' => 'BlogController@getSingle'])->where('slug', '[\w\d\-\_]+');
Route::get('blog', ['uses' => 'BlogController@getIndex', 'as' => 'blog.index']);
Route::get('contact', 'PagesController@getContact')->name('get.contact');
Route::get('about', 'PagesController@getAbout');	
Route::get('/', 'PagesController@getIndex');
Route::resource('inboxadmin', 'AdminInboxController');
Route::resource('posts', 'PostController');
Route::resource('comment', 'CommentController');
Route::resource('user', 'AdminRegisterController');
Route::resource('commentdel', 'CommentController');


Route::get('admin4xcg39op7log', ['uses' => 'AdminLoginController@login', 'as' => 'admin.login']);
Route::post('adminaccess', ['uses' => 'AdminLoginController@access', 'as' => 'admin.access']);

Route::post('adminlogout', function(){
        session()->forget('id');
        session()->flush();
        return redirect()->route('login');
});

Route::get('adminblog', function(){
        $adminid = session('id');
         $admin = Admin::where('id' , '=' , $adminid)->first();

        return view('admin.create')->withAdminid(session('id'))->withAdmin($admin);
})->name('admin.blog');

Route::post('adminlogin', function(Request $request){

       $admin = Admin::where('email' , '=' , $request->email)->first();
       if ($admin) {
       	session(['id' => $admin->id]);
       	return redirect()->route('admin.index');
       }else
      	 Session::flash('Errors', 'These credentials do not match our records.');

       	return redirect()->route('admin.login');
});

Route::resource('admin', 'AdminRegisterController');

Route::resource('inbox', 'InboxController');

Route::get('status/{id}/{returnid}', function($id, $returnid){
$comment = App\Comment::find($id);
         
$comment->status = 1;

$comment->save();

Session::flash('success' , '');

return redirect()->route('posts.show', $returnid);
      
})->name('status');


Route::get('drafts/{id}', ['uses' => 'PostController@drafts', 'as' => 'blog.drafts']);
Route::get('drafts', ['uses' => 'PostController@draftsindex', 'as' => 'drafts.index']);
