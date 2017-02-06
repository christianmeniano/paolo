	<head>
  @include('partials._head')
  @include('partials._javascript')
</head>


<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Laravel Blog</a>


    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
      
          <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{$admin->name}}<span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ route('admin.blog') }}">Blog</a></li>
                  <li><a href="{{ route('drafts.index') }}">Drafts</a></li>
                  <li><a href="{{ route('inboxadmin.index') }}">Inbox</a></li>
                                  <li>
                        <a href="{{ url('/adminlogout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ url('/adminlogout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                  </li>
                </ul>
            </li>


                       
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

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
           <input type="hidden" name="sender_id" value="{{$admin->id}}}">
           <input type="hidden" name="recepient_email" value="{{$message->email}}">
           <input type="hidden" name="subject" value="{{$message->subject}}">
           <input type="hidden" name="reply" value="1">
          {!!csrf_field()!!}
      </form>