@extends('main')

@section('title', 'Create New Post')

@section('stylesheets')

	{!! Html::style('css/parsley.css') !!}

@endsection

@section('content')

	<div class="row">
		<div class="col-md-3">
			<ul class="list-group">
				@foreach($messages as $message) 
				<label for="">From: </label>            
				<li class="list-group-item">{{$message->email}}
				<p>Subject: {{$message->subject}}</p>
				<a href="{{route('inbox.show', $message->id)}}" class="btn btn-primary btn-block">Read Message</a>
				</li>

				@endforeach
			</ul>
		</div>
		<div class="col-md-9">
		</div>
		
	</div>

@endsection