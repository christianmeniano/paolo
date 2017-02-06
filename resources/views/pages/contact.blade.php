@extends('main')

@section('title', 'Contact')

@section('content')
  <div class="row">
      <div class="col-md-12"></div>
      <h1>Contact Me</h1>
      <hr>
      <form action="{{route('inbox.store')}}" method="POST">
          <div class="form-group">
              <label for="email">Email: </label>
              <input type="text" id="email" name="recepient_email" class="form-control">
          </div>

          <div class="form-group">
              <label for="subject">Subject: </label>
              <input type="text" id="subject" name="subject" class="form-control">
          </div>
          <input type="hidden" name="sender_id" value="{{Auth::user()->id}}">

          <div class="form-group">
              <label for="message">Message:</label>
              
              <textarea type="text" id="message" name="message" class="form-control"></textarea>
              <br>
              <input type="submit" value="Send Message" class="btn btn-success">
          </div>
          {!!csrf_field()!!}
      </form>

  </div>
@endsection
