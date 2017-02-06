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
                  <li><a href="{{ route('admin.index') }}">Home</a></li>
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

<div class="row">
		<div class="col-md-8">
			<h2>Category:</h2>
			<h1>{{ $post->category }}</h1>
			<h2>Title:</h2>
			<h1>{{ $post->title }}</h1>
			<h2>Blog:</h2>
			<p class="lead">{!! $post->body !!}</p>
			<br><br>
		</div>
		<div class="col-md-4">																										
			<div class="well">

				<dl class="dl-horizontal">
					<label>Created At: Date</label>
					<p>{{ date('M j, Y h:i a', strtotime($post->created_at)) }}</p>
				</dl>

				<dl class="dl-horizontal">
					<label>Last Updated: Date</label>
					<p>{{ date('M j, Y h:i a', strtotime($post->updated_at)) }}</p>
				</dl>
				<hr>
				<div class="row">
					<div class="col-sm-6">
						{!! Html::linkroute('admin.edit', 'Edit', array($post->id), array('class' => 'btn btn-primary btn-block')) !!}
					</div>
					<div class="col-sm-6">
						{!! Form::open(['route' => ['admin.destroy', $post->id ], 'method' => 'DELETE']) !!}

						{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}

						{!! Form::close() !!}
					</div>
				</div>

			</div>
		</div>
	</div>

	</div>