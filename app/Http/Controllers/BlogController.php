<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;
use App\Comment;
use App\User;
class BlogController extends Controller
{

	public function getIndex(){
    	$posts = Post::paginate(2);

    	return view('blog.index')->withPosts($posts);
    }

    public function getSingle($slug){
    	$post = Post::where('slug', '=', $slug)->first();
    	$comment = Comment::join('users', 'comments.u_id', '=', 'users.id')
            ->select('users.*', 'comments.comment')
            ->where('blogger_id','=', $post->blogger_id)
            ->where('status', '=', 1)
            ->get();

    	return view('blog.single')->withPost($post)->withComments($comment);
    }


}
