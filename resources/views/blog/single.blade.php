@extends('main')

@section('title', "$post->title")

@section('content')
	
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>{{ $post->title }}</h1>
			{!! $post->body !!}
		
			@if (Auth::user()->id != $post->blogger_id)
			{!! Form::open(['route' => 'comment.store','data-parsley-validate' => '']) !!}

    			{{ Form::label('comment', 'Comment:') }}
    			{{ Form::textarea('comment', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
    			{{ Form::hidden('u_id', Auth::user()->id ) }}
    			{{ Form::hidden('blogger_id', $post->blogger_id ) }}
    			{{ Form::hidden('blog_id', $post->id ) }}
    			{{ Form::hidden('slug', $post->slug ) }}
    			<br>
    			{{ Form::submit('Submit Comment', array('class' => 'btn btn-success'))}}
			{!! Form::close() !!}
			@endif

			<br>
			<h1>Comments:</h1>
			@foreach($comments as $comment)
				<p>{{$comment->name}} : {{$comment->comment}}</p>
			@endforeach

		</div>
	</div>


@endsection