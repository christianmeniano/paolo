@extends('main')

@section('title', 'Create New Post')

@section('stylesheets')

	{!! Html::style('css/parsley.css') !!}

@endsection

@section('content')
	<h4>From: {{$message->email}}</h4>
	<p>Subject: {{$message->subject}}</p>
	<label for="">Message: </label>
	<div class="well">
		<label for="">{{$message->email}}</label>
		<p>{{$message->message}}</p>
	</div>
	<form action="{{route('inbox.store')}}" method="POST">
         
          <div class="form-group">
              <label for="message">Reply:</label>
              
              <textarea type="text" id="message" name="message" class="form-control"></textarea>
              <br>
              <input type="submit" value="Send Message" class="btn btn-success">
          </div>
           <input type="hidden" name="sender_id" value="{{Auth::user()->id}}">
           <input type="hidden" name="recepient_email" value="{{$message->email}}">
           <input type="hidden" name="subject" value="{{$message->subject}}">
           <input type="hidden" name="reply" value="1">
          {!!csrf_field()!!}
      </form>

@endsection