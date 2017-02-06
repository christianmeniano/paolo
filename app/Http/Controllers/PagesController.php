<?php 

namespace App\Http\Controllers;
use App\Post;

class PagesController extends Controller {

	public function getIndex(){
		$posts = Post::orderBy('created_at', 'desc')->limit(4)->get();
		return view('pages/welcome')->withPosts($posts);
	}

	public function getAbout(){
		$fname = 'Christian';
		$lname = 'Meniano';
		$fullname = $fname . " " . $lname;
		$email = 'c31216@gmail.com';
		$data = [];
		$data['email'] = $email;
		$data['fullname'] = $fullname;
		return view('pages/about')->withData($data);
	}

	public function getContact(){
		return view('pages/contact');
	}

}