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

@if (Session::has('success'))
  
  <div class="alert alert-success" role="alert">
    <strong>Success:{{ Session::get('success') }}</strong>
  </div>

@endif

<div class="container">

  <h4>Number of Users</h4>
  <div class="well">
  {{$users->count()}}
  </div>
  <h4>Number of blogs</h4>
  <div class="well">
  {{$posts->count()}}
  </div>

  <h4>List of Names </h4>
  <div class="well">
  @foreach($users as $user)
  <p>{{$user->name}}</p>

  {!! Form::open(['route' => ['user.destroy', $user->id ],  'method' => 'DELETE']) !!}


            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}

            {!! Form::close() !!}

  @endforeach
  </div>
 



  <h4>List of Posts</h4>
  <div class="well">
   @foreach($posts as $post)
  <p>{{$post->title}}</p>
  {!! Html::linkroute('admin.show', 'View', [$post->id], array('class' => 'btn btn-primary')) !!}
  
  {{ csrf_field() }}
  @endforeach
  </div>


   
</div>