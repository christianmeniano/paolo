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
                  <li><a href="{{ route('admin.index') }}">Blog</a></li>
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

	<div class="row">
		<div class="col-md-3">
			<ul class="list-group">
				@foreach($messages as $message) 
				<label for="">From: {{$message->email}}</label>            
				<li class="list-group-item">{{$message->email}}
				<p>Subject: {{$message->subject}}</p>
				<a href="{{route('inboxadmin.show', $message->id)}}" class="btn btn-primary btn-block">Read Message</a>
				</li>

				@endforeach
			</ul>
		</div>
		<div class="col-md-9">
		</div>
		
	</div>
